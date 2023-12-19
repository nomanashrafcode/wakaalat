<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Admin;
use Hash;
use App\BannerImage;
use App\ManageText;
use App\ValidationText;
use App\NotificationText;
class AdminLoginController extends Controller
{


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('adminLogout');
    }


    public function adminLoginForm(){
        $isAdmin=Admin::all()->count();
        $image=BannerImage::first();
        $website_lang=ManageText::all();
        return view('admin.auth.login',compact('isAdmin','image','website_lang'));
    }

    public function storeLoginInfo(Request $request){
        $valid_lang=ValidationText::all();
        $rules = [
            'email'=>'required',
            'password'=>'required'
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

        $isAdmin=Admin::where('email',$request->email)->first();
        if($isAdmin){
            if($isAdmin->status==1){
                if(Hash::check($request->password,$isAdmin->password)){
                    if(Auth::guard('admin')->attempt($credential,$request->remember)){

                        $notify_lang=NotificationText::all();
                        $notification=$notify_lang->where('lang_key','login')->first()->custom_lang;
                        $notification=array('messege'=>$notification,'alert-type'=>'success');

                        return Redirect()->intended(route('admin.dashboard'))->with($notification);
                    }

                    $notify_lang=NotificationText::all();
                    $notification=$notify_lang->where('lang_key','wrong')->first()->custom_lang;
                    $notification=array('messege'=>$notification,'alert-type'=>'error');
                    return Redirect()->back()->with($notification);
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
            $notification=$notify_lang->where('lang_key','credential')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return Redirect()->back()->with($notification);
        }



    }

    public function adminLogout(){
        Auth::guard('admin')->logout();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','logout')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.login')->with($notification);
    }
}
