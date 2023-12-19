<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\PaymentExecution;
use Cart;
use App\Appointment;
use App\Order;
use App\Lawyer;
use Auth;
use App\PaymentAccount;
use App\Setting;
use App\Mail\OrderConfirmation;
use Mail;
use App\EmailTemplate;
use App\NotificationText;
use App\Helpers\MailHelper;
class PaypalController extends Controller
{
    private $apiContext;
    public function __construct()
    {
        $account=PaymentAccount::first();
    /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->apiContext = new ApiContext(new OAuthTokenCredential(
            $account->paypal_client_id,
            $account->paypal_secret,
            )
        );

        $setting=array(
            'mode' => $account->account_mode,
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path() . '/logs/paypal.log',
            'log.LogLevel' => 'ERROR'
        );
        $this->apiContext->setConfig($setting);
    }
    public function paypal(){
        return view('paypal');
    }

    public function store(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        $cartPrice = str_replace( array( '\'', '"', ',' , ';', '<', '>' ), '', Cart::pricetotal());
        $price=$cartPrice;
        $name="Lawyer Appointment";

        // set payer
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $currency=Setting::first();
        $setting = $currency;
        $paypalSetting=PaymentAccount::first();
        $amount_usd = round($price / $setting->currency_rate,2);
        $payableAmount= round($price * $paypalSetting->paypal_currency_rate,2);

        // set amount total
        $amount = new Amount();
        $cr=strtoupper($currency->currency_name);
        $amount->setCurrency($paypalSetting->paypal_currency_code)
            ->setTotal($payableAmount);

        // transaction
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setDescription("Lawyer Appointment");


        // redirect url
        $redirectUrls = new RedirectUrls();

        $root_url=url('/');
        $redirectUrls->setReturnUrl($root_url."/client/paypal-payment-success")
            ->setCancelUrl($root_url."/client/paypal-payment-cancled");

        // payment
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
        try {
            $payment->create($this->apiContext);
        } catch (\PayPal\Exception\PPConnectionException $ex) {

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','payment_failed')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'error');


            return redirect()->route('client.payment')->with($notification);
        }

        // get paymentlink
        $approvalUrl = $payment->getApprovalLink();

        return redirect($approvalUrl);
    }

    public function paymentSuccess(Request $request){

        if (empty($request->get('PayerID')) || empty($request->get('token'))) {
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','payment_failed')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'error');

            return redirect()->route('client.payment')->with($notification);
        }

        $payment_id=$request->get('paymentId');
        $payment = Payment::get($payment_id, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        if ($result->getState() == 'approved') {
            $user=Auth::guard('web')->user();
            $currency=Setting::first();
            $setting = $currency;
            // insert order
            $order= Order::create([
                'user_id'=>$user->id,
                'order_id'=>'#'.date('Yms').rand(9,99),
                'total_payment'=>str_replace( array( '\'', '"', ',' , ';', '<', '>' ), '', Cart::pricetotal()),
                'appointment_qty'=>Cart::count(),
                'payment_method'=>'Paypal',
                'payment_status'=>1,
                'payment_transaction_id'=>$payment_id
            ]);

            $order_details='';
            foreach(Cart::content() as $item){
                Appointment::create([
                    'order_id'=>$order->id,
                    'lawyer_id'=>$item->options->lawyer_id,
                    'user_id'=>$user->id,
                    'day_id'=>$item->options->day_id,
                    'schedule_id'=>$item->options->schedule_id,
                    'date'=>date('Y-m-d',strtotime($item->options->date)),
                    'appointment_fee'=>$item->price,
                    'payment_status'=>1,
                    'payment_transaction_id'=>$result->balance_transaction,
                    'payment_method'=>'Paypal',

                ]);

                $lawyer=Lawyer::find($item->options->lawyer_id);
                $order_details.='Lawyer: '. $lawyer->name. '<br>';
                $order_details.='Phone: '. $lawyer->phone .'<br>';
                $order_details.='Schedule: '.$item->options->time .'<br>';
                $order_details.='Date: '.$item->options->date.'<br>';
            }

            Cart::destroy();

            // send email
            $template=EmailTemplate::where('id',6)->first();
            $message=$template->description;
            $subject=$template->subject;
            $message=str_replace('{{client_name}}',$user->name,$message);
            $message=str_replace('{{orderId}}', $order->order_id ,$message);
            $message=str_replace('{{payment_method}}','Paypal',$message);
            $total_amount=$currency->currency_icon. $order->total_payment;
            $message=str_replace('{{amount}}',$total_amount,$message);
            $message=str_replace('{{order_details}}',$order_details,$message);
            MailHelper::setMailConfig();
            Mail::to($user->email)->send(new OrderConfirmation($message,$subject));

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','payment_success')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'success');

            return redirect()->route('client.order')->with($notification);

        }

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','payment_failed')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'error');

        return redirect()->route('client.payment')->with($notification);
    }
    public function paymentCancled(){
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','payment_failed')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'error');

        return redirect()->route('client.payment')->with($notification);
    }
}
