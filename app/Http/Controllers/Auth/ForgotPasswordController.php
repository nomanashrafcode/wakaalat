<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\User;
use App\Mail\ForgetPassword;
use Str;
use Mail;
use Hash;
use Auth;
use App\Rules\Captcha;
use App\Setting;
use App\BannerImage;
use App\Navigation;
use App\ManageText;
use App\EmailTemplate;
use App\ValidationText;
use App\NotificationText;
use App\Helpers\MailHelper;
class ForgotPasswordController extends Controller
{
   public function forgetPassword(){
        $setting=Setting::first();
        $banner=BannerImage::first();
        $navigation=Navigation::first();
        $website_lang=ManageText::all();
        return view('client.profile.auth.forget-password')->with(['setting'=>$setting,'banner'=>$banner,'navigation'=>$navigation,'website_lang'=>$website_lang]);
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
            'email'=>'required|email',
            'g-recaptcha-response'=>new Captcha()
        ];

        $customMessages = [
            'email.required' => $valid_lang->where('lang_key','req_email')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);

        $user=User::where('email',$request->email)->first();
        $notify=NotificationText::first();
        if($user){
            $user->forget_password_token=Str::random(100);
            $user->save();
            $website_lang=ManageText::all();
            $reset_pass_text=$website_lang->where('lang_key','reset_password')->first()->custom_lang;
            $template=EmailTemplate::where('id',1)->first();
            $message=$template->description;
            $subject=$template->subject;
            $message=str_replace('{{name}}',$user->name,$message);
            MailHelper::setMailConfig();
            Mail::to($user->email)->send(new ForgetPassword($user,$message,$subject,$reset_pass_text));
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','forget_pass')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'success');
            return back()->with($notification);

        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','email_not_exist')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return Redirect()->back()->with($notification);
        }

   }

   public function resetPassword($token){
        $user=User::where('forget_password_token',$token)->first();
        $notify=NotificationText::first();
        if($user){
            $setting=Setting::first();
            $banner=BannerImage::first();
            $navigation=Navigation::first();
            $website_lang=ManageText::all();
            return view('client.profile.auth.reset-password',compact('user','token','setting','banner','navigation','website_lang'));
        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','invalid_token')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'error');

            return Redirect()->route('forget.password')->with($notification);
        }
   }


   public function storeResetData(Request $request,$token){

        $valid_lang=ValidationText::all();
        $rules = [
            'email'=>'required|email',
            'password'=>'required|confirmed',
            'g-recaptcha-response'=>new Captcha()
        ];

        $customMessages = [
            'email.required' => $valid_lang->where('lang_key','req_email')->first()->custom_lang,
            'password.required' => $valid_lang->where('lang_key','req_pass')->first()->custom_lang,
            'password.confirmed' => $valid_lang->where('lang_key','confirm_pass')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);



        $notify=NotificationText::first();
        $user=User::where('forget_password_token',$token)->first();
        if($user->email==$request->email){
            $user->password=Hash::make($request->password);
            $user->forget_password_token=null;
            $user->save();

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','reset_pass')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'success');
            return Redirect()->route('login')->with($notification);

        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','email_not_exist')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'error');

            return back()->with($notification);
        }
   }


}
