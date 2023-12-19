<?php

namespace App\Http\Controllers\Lawyer\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\User;
use App\Lawyer;
use App\Mail\ForgetPassword;
use App\Mail\DoctorForgetPassword;
use Str;
use Mail;
use Hash;
use Auth;
use App\BannerImage;
use App\ManageText;
use App\ValidationText;
use App\EmailTemplate;
use App\Helpers\MailHelper;
use App\NotificationText;
class LawyerForgotPasswordController extends Controller
{
   public function forgetPassword(){
        $image=BannerImage::first();
        $website_lang=ManageText::all();
       return view('lawyer.auth.forget-password',compact('image','website_lang'));
   }

   public function sendForgetEmail(Request $request){

    // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        $rules = [
            'email'=>'required'
        ];

        $customMessages = [
            'email.required' => $valid_lang->where('lang_key','req_email')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);

        $lawyer=Lawyer::where('email',$request->email)->first();
        if($lawyer){
            $lawyer->forget_password_token=Str::random(100);
            $lawyer->save();

            $template=EmailTemplate::where('id',1)->first();
            $message=$template->description;
            $subject=$template->subject;
            $message=str_replace('{{name}}',$lawyer->name,$message);

            $website_lang=ManageText::all();
            $reset_pass_text=$website_lang->where('lang_key','reset_password')->first()->custom_lang;

            MailHelper::setMailConfig();
            Mail::to($lawyer->email)->send(new DoctorForgetPassword($lawyer,$message,$subject,$reset_pass_text));

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','forget_pass')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'success');

            return back()->with($notification);

        }else {

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','email_not_exist')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return back()->with($notification);
        }

   }

   public function resetPassword($token){
        $lawyer=Lawyer::where('forget_password_token',$token)->first();
        $image=BannerImage::first();
        if($lawyer){
            $website_lang=ManageText::all();
            return view('lawyer.auth.reset-password',compact('lawyer','token','image','website_lang'));
        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','invalid_token')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return Redirect()->route('lawyer.forget.password')->with($notification);
        }
   }


   public function storeResetData(Request $request,$token){
        $valid_lang=ValidationText::all();
        $rules = [
            'email'=>'required',
            'password'=>'required|confirmed'
        ];

        $customMessages = [
            'email.required' => $valid_lang->where('lang_key','req_email')->first()->custom_lang,
            'password.required' => $valid_lang->where('lang_key','req_pass')->first()->custom_lang,
            'password.confirmed' => $valid_lang->where('lang_key','confirm_pass')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);

        $lawyer=Lawyer::where('forget_password_token',$token)->first();
        if($lawyer->email==$request->email){
            $lawyer->password=Hash::make($request->password);
            $lawyer->forget_password_token=null;
            $lawyer->save();

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','reset_pass')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'success');
            return Redirect()->route('lawyer.login')->with($notification);

        }else {
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','email_not_exist')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return back()->with($notification);
        }
   }


}
