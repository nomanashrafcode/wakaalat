<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
use App\Rules\Captcha;
use App\Setting;
use App\BannerImage;
use App\Navigation;
use App\ManageText;
use App\ValidationText;
use App\NotificationText;

class LoginController extends Controller
{


    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest:web')->except('userLogout');
    }

    public function userLoginPage(){
        $setting=Setting::first();
        $banner=BannerImage::first();
        $navigation=Navigation::first();
        $website_lang=ManageText::all();
        return view('client.profile.auth.login')->with(['setting'=> $setting,'banner'=>$banner,'navigation'=>$navigation,'website_lang'=>$website_lang]);
    }

    public function storeLogin(Request $request){

        $valid_lang=ValidationText::all();
        $rules = [
            'email'=>'required',
            'password'=>'required',
            'g-recaptcha-response'=>new Captcha()
        ];

        $customMessages = [
            'email.required' => $valid_lang->where('lang_key','req_email')->first()->custom_lang,
            'password.required' => $valid_lang->where('lang_key','req_pass')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);

        $credential=[
            'email'=> $request->email,
            'password'=> $request->password
        ];

        $notify=NotificationText::first();
        $user=User::where('email',$request->email)->first();
        if($user){
            if($user->status==1){
                if(Hash::check($request->password,$user->password)){
                    if(Auth::guard('web')->attempt($credential,$request->remember)){
                        $notify_lang=NotificationText::all();
                        $notification=$notify_lang->where('lang_key','login')->first()->custom_lang;
                        $notification=array('messege'=>$notification,'alert-type'=>'success');
                        return Redirect()->intended(route('client.dashboard'))->with($notification);
                    }
                }else{
                    $notify_lang=NotificationText::all();
                    $notification=$notify_lang->where('lang_key','credential')->first()->custom_lang;
                    $notification=array('messege'=>$notification,'alert-type'=>'error');

                    return Redirect()->back()->with($notification);
                }

            }else{
                $notify_lang=NotificationText::all();
                $notification=$notify_lang->where('lang_key','deactive_account')->first()->custom_lang;
                $notification=array('messege'=>$notification,'alert-type'=>'error');

                return Redirect()->back()->with($notification);
            }
        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','email_not_exist')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'error');

            return Redirect()->back()->with($notification);
        }
    }

    public function userLogout(){
        Auth::guard('web')->logout();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','logout')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return Redirect()->route('login')->with($notification);
    }
}
