<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Mail\UserVerification;
use Str;
use Mail;
use App\Rules\Captcha;
use App\Setting;
use App\BannerImage;
use App\Navigation;
use App\ManageText;
use App\EmailTemplate;
use App\ValidationText;
use App\NotificationText;
use App\Helpers\MailHelper;
class RegisterController extends Controller
{


    use RegistersUsers;


    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware('guest:web');
    }


    public function userRegisterPage(){
        $setting=Setting::first();
        $banner=BannerImage::first();
        $navigation=Navigation::first();
        $website_lang=ManageText::all();
        return view('client.profile.auth.register')->with(['setting'=>$setting,'banner'=>$banner,'navigation'=>$navigation,'website_lang'=>$website_lang]);
    }

    public function storeRegister(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $notify=NotificationText::first();
        $valid_lang=ValidationText::all();
        $rules = [
            'name'=>'required',
            'email'=>'required|unique:users|email',
            'password'=>'required',
            'g-recaptcha-response'=>new Captcha()
        ];

        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','req_name')->first()->custom_lang,
            'email.required' => $valid_lang->where('lang_key','req_email')->first()->custom_lang,
            'email.unique' => $valid_lang->where('lang_key','unique_email')->first()->custom_lang,
            'password.required' => $valid_lang->where('lang_key','req_pass')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);


        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'client_id'=>date('ymdis'),
            'email_verified_token'=>Str::random(100)
        ]);

        $template=EmailTemplate::where('id',5)->first();
        $message=$template->description;
        $subject=$template->subject;
        $message=str_replace('{{user_name}}',$user->name,$message);
        MailHelper::setMailConfig();
        Mail::to($user->email)->send(new UserVerification($user,$message,$subject));


        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','register')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return Redirect()->back()->with($notification);
    }

    public function userVerify($token){
        $user=User::where('email_verified_token',$token)->first();
        $notify=NotificationText::first();
        if($user){
            $user->email_verified_token=null;
            $user->status=1;
            $user->email_verified=1;
            $user->save();
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','verify_success')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'success');
            return  redirect()->route('login')->with($notification);
        }else{

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','invalid_token')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->route('register')->with($notification);
        }
    }
}
