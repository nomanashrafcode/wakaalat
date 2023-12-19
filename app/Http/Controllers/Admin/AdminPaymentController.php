<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Appointment;
use App\Lawyer;
use Carbon\Carbon;
use App\Setting;
use App\ManageText;
use App\ValidationText;
class AdminPaymentController extends Controller
{
    public function payment(){
        $appointments=Appointment::where([
            'payment_status'=>1
        ])->get();
        $lawyers=Lawyer::where('status',1)->get();
        $currency=Setting::first();

        $lawyerPayments=Lawyer::with('appointments')->where(['status'=>1])->get();

        $lawyerPayments=Appointment::where('payment_status',1)->get();

        $website_lang=ManageText::all();
        return view('admin.payment.index',compact('appointments','lawyers','currency','lawyerPayments','website_lang'));
    }

    public function paymentSearch(Request $request){
        $valid_lang=ValidationText::all();
        $rules = [
            'from_date'=>'required',
            'to_date'=>'required',
        ];

        $customMessages = [
            'from_date.required' => $valid_lang->where('lang_key','req_from_date')->first()->custom_lang,
            'to_date.required' => $valid_lang->where('lang_key','req_to_date')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);

        $lawyers=Lawyer::where('status',1)->get();
        $appointments=Appointment::where([
            'payment_status'=>1
        ])->get();

        $from_date=date('Y-m-d',strtotime($request->from_date));
        $to_date=date('Y-m-d',strtotime($request->to_date));

        $appointments=$appointments->whereBetween('date', array($from_date, $to_date));
        if($request->lawyer_id) $appointments= $appointments->where('lawyer_id',$request->lawyer_id);
        $currency=Setting::first();

        $website_lang=ManageText::all();
        return view('admin.payment.ajax-payment',compact('appointments','currency','lawyers','website_lang'));


    }
}
