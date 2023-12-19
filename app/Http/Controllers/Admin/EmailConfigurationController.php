<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
use App\EmailConfiguration;

class EmailConfigurationController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

        $email=EmailConfiguration::first();
        $website_lang=ManageText::all();
        return view('admin.email-configuration.index',compact('email','website_lang'));
    }

    public function update(Request $request){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        $rules = [
            'email'=>'required',
            'mail_host'=>'required',
            'mail_port'=>'required',
            'mail_encryption'=>'required',
            'smtp_username'=>'required',
            'smtp_password'=>'required',
        ];
        $customMessages = [
            'email.required' => $valid_lang->where('lang_key','req_email')->first()->custom_lang,
            'mail_host.required' => $valid_lang->where('lang_key','req_mail_host')->first()->custom_lang,
            'mail_port.required' => $valid_lang->where('lang_key','req_mail_port')->first()->custom_lang,
            'mail_encryption.required' => $valid_lang->where('lang_key','req_mail_encryption')->first()->custom_lang,
            'smtp_username.required' => $valid_lang->where('lang_key','req_smtp_user')->first()->custom_lang,
            'smtp_password.required' => $valid_lang->where('lang_key','req_smtp_pass')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);



        $email=EmailConfiguration::first();
        $email->email=$request->email;
        $email->mail_host=$request->mail_host;
        $email->mail_port=$request->mail_port;
        $email->smtp_username=$request->smtp_username;
        $email->smtp_password=$request->smtp_password;
        $email->mail_encryption=$request->mail_encryption;
        $email->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.email-configuration')->with($notification);

    }
}
