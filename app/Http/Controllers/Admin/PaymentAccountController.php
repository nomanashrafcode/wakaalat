<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PaymentAccount;
use App\ManageText;
use App\ValidationText;
use Illuminate\Http\Request;
use App\NotificationText;
use App\Razorpay;
use App\Flutterwave;
use Image;
use File;
use App\PaystackAndMollie;
use App\InstamojoPayment;
use App\Setting;
use App\CurrencyCountry;
use App\Currency;
use App\PaymongoPayment;

class PaymentAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {   $paymentAccount=PaymentAccount::first();
        if($paymentAccount){
            $website_lang=ManageText::all();
            $razorpay=Razorpay::first();
            $flutterwave=Flutterwave::first();

            $paystack = PaystackAndMollie::first();
            $mollie = $paystack;
            $countires = CurrencyCountry::orderBy('name','asc')->get();
            $currencies = Currency::orderBy('name','asc')->get();
            $setting = Setting::first();
            $instamojo = InstamojoPayment::first();
            $paymongo = PaymongoPayment::first();

            return view('admin.payment-account.edit',compact('paymentAccount','website_lang','razorpay','flutterwave','paystack','countires','currencies','setting','mollie','instamojo','paymongo'));
        }

    }




    public function update(Request $request, PaymentAccount $paymentAccount)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end;


        $valid_lang=ValidationText::all();
        $rules = [
            'account_mode'=>'required',
            'paypal_client_id'=>'required',
            'paypal_secret'=>'required',
            'paypal_status'=>'required',
            'paypal_country_code'=>'required',
            'paypal_currency_code'=>'required',
            'paypal_currency_rate'=>'required|numeric',
        ];

        $customMessages = [
            'account_mode.required' => $valid_lang->where('lang_key','req_account_mode')->first()->custom_lang,
            'paypal_client_id.required' => $valid_lang->where('lang_key','req_paypal_client_id')->first()->custom_lang,
            'paypal_secret.required' => $valid_lang->where('lang_key','req_paypal_secret')->first()->custom_lang,
            'paypal_country_code.required' => $valid_lang->where('lang_key','country')->first()->custom_lang,
            'paypal_currency_code.required' => $valid_lang->where('lang_key','currency')->first()->custom_lang,
            'paypal_currency_rate.required' => $valid_lang->where('lang_key','currency_rate')->first()->custom_lang
        ];

        $this->validate($request, $rules, $customMessages);

        $paymentAccount->account_mode=$request->account_mode;
        $paymentAccount->paypal_client_id=$request->paypal_client_id;
        $paymentAccount->paypal_secret=$request->paypal_secret;
        $paymentAccount->paypal_status=$request->paypal_status;
        $paymentAccount->paypal_country_code=$request->paypal_country_code;
        $paymentAccount->paypal_currency_code=$request->paypal_currency_code;
        $paymentAccount->paypal_currency_rate=$request->paypal_currency_rate;
        $paymentAccount->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.payment-account.index')->with($notification);
    }


    public function stripeUpdate(Request $request , $id){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end;

        $valid_lang=ValidationText::all();

        $rules = [
            'stripe_key'=>'required',
            'stripe_secret'=>'required',
            'stripe_status'=>'required',
            'stripe_country_code'=>'required',
            'stripe_currency_code'=>'required',
            'stripe_currency_rate'=>'required|numeric',
        ];

        $customMessages = [
            'stripe_key.required' => $valid_lang->where('lang_key','req_stripe_key')->first()->custom_lang,
            'stripe_secret.required' => $valid_lang->where('lang_key','req_stripe_secret')->first()->custom_lang,
            'stripe_country_code.required' => $valid_lang->where('lang_key','country')->first()->custom_lang,
            'stripe_currency_code.required' => $valid_lang->where('lang_key','currency')->first()->custom_lang,
            'stripe_currency_rate.required' => $valid_lang->where('lang_key','currency_rate')->first()->custom_lang
        ];

        $this->validate($request, $rules, $customMessages);
        $paymentAccount=PaymentAccount::find($id);
        $paymentAccount->stripe_key=$request->stripe_key;
        $paymentAccount->stripe_secret=$request->stripe_secret;
        $paymentAccount->stripe_status=$request->stripe_status;
        $paymentAccount->stripe_country_code=$request->stripe_country_code;
        $paymentAccount->stripe_currency_code=$request->stripe_currency_code;
        $paymentAccount->stripe_currency_rate=$request->stripe_currency_rate;
        $paymentAccount->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.payment-account.index')->with($notification);
    }


    public function bankUpdate(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end;

        $valid_lang=ValidationText::all();
        $rules = [
            'bank_account'=>'required',
            'bank_status'=>'required',
        ];

        $customMessages = [
            'bank_account.required' => $valid_lang->where('lang_key','req_bank_account')->first()->custom_lang,
        ];

        $this->validate($request, $rules,$customMessages);

        $paymentAccount=PaymentAccount::find($id);
        $paymentAccount->bank_account=$request->bank_account;
        $paymentAccount->bank_status=$request->bank_status;
        $paymentAccount->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.payment-account.index')->with($notification);
    }

    public function razorpayUpdate(Request $request,$id){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end;

        $valid_lang=ValidationText::all();
        $rules = [
            'razorpay_key'=>'required',
            'razorpay_secret'=>'required',
            'name'=>'required',
            'description'=>'required',
            'razorpay_status'=>'required',
            'country_code'=>'required',
            'currency_code'=>'required',
            'currency_rate'=>'required|numeric',
        ];
        $customMessages = [
            'razorpay_key.required' => $valid_lang->where('lang_key','razorpay_key')->first()->custom_lang,
            'razorpay_secret.required' => $valid_lang->where('lang_key','razorpay_secret')->first()->custom_lang,
            'name.required' => $valid_lang->where('lang_key','req_name')->first()->custom_lang,
            'description.required' => $valid_lang->where('lang_key','req_des')->first()->custom_lang,
            'currency_rate.required' => $valid_lang->where('lang_key','currency_rate')->first()->custom_lang,
            'country_code.required' => $valid_lang->where('lang_key','country')->first()->custom_lang,
            'currency_code.required' => $valid_lang->where('lang_key','currency')->first()->custom_lang,
        ];
        $this->validate($request, $rules,$customMessages);

        $razorpay=Razorpay::find($id);
        $razorpay->razorpay_key=$request->razorpay_key;
        $razorpay->secret_key=$request->razorpay_secret;
        $razorpay->name=$request->name;
        $razorpay->description=$request->description;
        $razorpay->theme_color=$request->theme_color;
        $razorpay->currency_rate=$request->currency_rate;
        $razorpay->razorpay_status=$request->razorpay_status;
        $razorpay->razorpay_status=$request->razorpay_status;
        $razorpay->country_code=$request->country_code;
        $razorpay->currency_code=$request->currency_code;
        $razorpay->save();

        if($request->image){
            $old_image=$razorpay->image;
            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $image_name= 'razorpay-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name='uploads/website-images/'.$image_name;
            Image::make($image)
                ->save(public_path().'/'.$image_name);
            $razorpay->image=$image_name;
            $razorpay->save();
            if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
        }

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.payment-account.index')->with($notification);

    }

    public function flutterwaveUpdate(Request $request, $id){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end;
        $rules = [
            'public_key'=>'required',
            'secret_key'=>'required',
            'title'=>'required',
            'status'=>'required',
            'country_code'=>'required',
            'currency_code'=>'required',
            'currency_rate'=>'required|numeric',
        ];
        $valid_lang=ValidationText::all();
        $customMessages = [
            'public_key.required' => $valid_lang->where('lang_key','public_key')->first()->custom_lang,
            'secret_key.required' => $valid_lang->where('lang_key','secret_key')->first()->custom_lang,
            'title.required' => $valid_lang->where('lang_key','req_title')->first()->custom_lang,
            'country_code.required' => $valid_lang->where('lang_key','country')->first()->custom_lang,
            'currency_code.required' => $valid_lang->where('lang_key','currency')->first()->custom_lang,
            'currency_rate.required' => $valid_lang->where('lang_key','currency_rate')->first()->custom_lang
        ];
        $this->validate($request, $rules, $customMessages);

        $flutterwave = Flutterwave::find($id);
        $flutterwave->public_key = $request->public_key;
        $flutterwave->secret_key = $request->secret_key;
        $flutterwave->title = $request->title;
        $flutterwave->status = $request->status;
        $flutterwave->country_code=$request->country_code;
        $flutterwave->currency_code=$request->currency_code;
        $flutterwave->currency_rate=$request->currency_rate;
        $flutterwave->save();

        if($request->image){
            $old_image=$flutterwave->logo;
            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $image_name= 'flutterwave-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name='uploads/website-images/'.$image_name;
            Image::make($image)
                ->save(public_path().'/'.$image_name);
            $flutterwave->logo=$image_name;
            $flutterwave->save();
            if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
        }


        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.payment-account.index')->with($notification);
    }

    public function paystackUpdate(Request $request, $id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        $rules = [
            'paystack_public_key' => $request->status ? 'required' : '',
            'paystack_secret_key' => $request->status ? 'required' : '',
            'paystack_currency_rate' => 'required|numeric',
            'paystack_currency_name' => $request->status ? 'required' : '',
            'paystack_country_name' => $request->status ? 'required' : ''
        ];

        $customMessages = [
            'paystack_public_key.required' => $valid_lang->where('lang_key','public_key')->first()->custom_lang,
            'paystack_secret_key.required' => $valid_lang->where('lang_key','secret_key')->first()->custom_lang,
            'paystack_currency_rate.required' => $valid_lang->where('lang_key','currency_rate')->first()->custom_lang,
            'paystack_currency_name.required' => $valid_lang->where('lang_key','currency')->first()->custom_lang,
            'paystack_country_name.required' => $valid_lang->where('lang_key','country')->first()->custom_lang,
        ];
        $this->validate($request, $rules,$customMessages);

        $paystact = PaystackAndMollie::first();
        $paystact->paystack_public_key = $request->paystack_public_key;
        $paystact->paystack_secret_key = $request->paystack_secret_key;
        $paystact->paystack_currency_code = $request->paystack_currency_name;
        $paystact->paystack_country_code = $request->paystack_country_name;
        $paystact->paystack_currency_rate = $request->paystack_currency_rate;
        $paystact->paystack_status = $request->status ? 1 : 0;
        $paystact->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.payment-account.index')->with($notification);
    }

    public function updateMollie(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();

        $rules = [
            'mollie_key' => 'required',
            'mollie_currency_rate' => 'required|numeric',
            'mollie_country_name' => 'required',
            'mollie_currency_name' => 'required'
        ];

        $customMessages = [
            'mollie_key.required' => $valid_lang->where('lang_key','mollie_key')->first()->custom_lang,
            'mollie_currency_rate.required' => $valid_lang->where('lang_key','currency_rate')->first()->custom_lang,
            'mollie_currency_name.required' => $valid_lang->where('lang_key','currency')->first()->custom_lang,
            'mollie_country_name.required' => $valid_lang->where('lang_key','country')->first()->custom_lang,

        ];
        $this->validate($request, $rules,$customMessages);

        $mollie = PaystackAndMollie::first();
        $mollie->mollie_key = $request->mollie_key;
        $mollie->mollie_currency_rate = $request->mollie_currency_rate;
        $mollie->mollie_currency_code = $request->mollie_currency_name;
        $mollie->mollie_country_code = $request->mollie_country_name;
        $mollie->mollie_status = $request->status ? 1 : 0;
        $mollie->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.payment-account.index')->with($notification);
    }


    public function updateInstamojo(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        $valid_lang=ValidationText::all();

        $rules = [
            'account_mode' => $request->status ? 'required' : '',
            'api_key' => $request->status ? 'required' : '',
            'auth_token' => $request->status ? 'required' : '',
            'currency_rate' => $request->status ? 'required|numeric' : '',
        ];
        $customMessages = [
            'api_key.required' => $valid_lang->where('lang_key','api_key')->first()->custom_lang,
            'auth_token.required' => $valid_lang->where('lang_key','auth_token')->first()->custom_lang,
            'currency_rate.required' => $valid_lang->where('lang_key','currency_rate')->first()->custom_lang,


        ];
        $this->validate($request, $rules,$customMessages);

        $instamojo = InstamojoPayment::first();
        $instamojo->account_mode = $request->account_mode;
        $instamojo->api_key = $request->api_key;
        $instamojo->auth_token = $request->auth_token;
        $instamojo->currency_rate = $request->currency_rate;
        $instamojo->status = $request->status ? 1 : 0;
        $instamojo->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.payment-account.index')->with($notification);
    }


    public function updateIPaymongo(Request $request, $id){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end;
        $rules = [
            'public_key'=>'required',
            'secret_key'=>'required',
            'status'=>'required',
            'country_code'=>'required',
            'currency_code'=>'required',
            'currency_rate'=>'required|numeric',
        ];
        $valid_lang=ValidationText::all();
        $customMessages = [
            'public_key.required' => $valid_lang->where('lang_key','public_key')->first()->custom_lang,
            'secret_key.required' => $valid_lang->where('lang_key','secret_key')->first()->custom_lang,
            'country_code.required' => $valid_lang->where('lang_key','country')->first()->custom_lang,
            'currency_code.required' => $valid_lang->where('lang_key','currency')->first()->custom_lang,
            'currency_rate.required' => $valid_lang->where('lang_key','currency_rate')->first()->custom_lang
        ];
        $this->validate($request, $rules, $customMessages);

        $paymongo = PaymongoPayment::find($id);
        $paymongo->public_key = $request->public_key;
        $paymongo->secret_key = $request->secret_key;
        $paymongo->status = $request->status;
        $paymongo->country_code=$request->country_code;
        $paymongo->currency_code=$request->currency_code;
        $paymongo->currency_rate=$request->currency_rate;
        $paymongo->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.payment-account.index')->with($notification);
    }

}
