<?php

namespace App\Http\Controllers\Lawyer\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Admin;
use App\Lawyer;
use App\BannerImage;
use App\ManageText;
use App\ValidationText;
use App\NotificationText;
use Hash;
class LawyerLoginController extends Controller
{


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/lawyer/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:lawyer')->except('lawyerLogout');
    }


    public function lawyerLoginForm(){
        $image=BannerImage::first();
        $website_lang=ManageText::all();
        return view('lawyer.auth.login',compact('image','website_lang'));
    }

    public function storeLoginInfo(Request $request){
        $valid_lang=ValidationText::all();
        $rules = [
            'email'=>'required|email',
            'password'=>'required',
        ];

        $customMessages = [
            'email.required' => $valid_lang->where('lang_key','req_email')->first()->custom_lang,
            'password.required' => $valid_lang->where('lang_key','req_pass')->first()->custom_lang
        ];
        $this->validate($request, $rules, $customMessages);



        $credential=[
            'email'=> $request->email,
            'password'=> $request->password
        ];

        $isDoctor=Lawyer::where('email',$request->email)->first();
        if($isDoctor){
            if(Hash::check($request->password,$isDoctor->password)){
                if(Auth::guard('lawyer')->attempt($credential,$request->remember)){

                    $notify_lang=NotificationText::all();
                    $notification=$notify_lang->where('lang_key','login')->first()->custom_lang;
                    $notification=array('messege'=>$notification,'alert-type'=>'success');

                    return Redirect()->intended(route('lawyer.dashboard'))->with($notification);
                }

                $notify_lang=NotificationText::all();
                $notification=$notify_lang->where('lang_key','wrong')->first()->custom_lang;
                $notification=array('messege'=>$notification,'alert-type'=>'error');

                return Redirect()->back()->withInput($request->only('email,remember'))->with($notification);
            }else{

                $notify_lang=NotificationText::all();
                $notification=$notify_lang->where('lang_key','credential')->first()->custom_lang;
                $notification=array('messege'=>$notification,'alert-type'=>'error');
                return back()->with($notification);
            }

        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','credential')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return back()->with($notification);
        }



    }

    public function lawyerLogout(){
        Auth::guard('lawyer')->logout();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','logout')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('lawyer.login')->with($notification);
    }

}
