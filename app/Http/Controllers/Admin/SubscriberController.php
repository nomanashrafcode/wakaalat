<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subscribe;
use App\SubscriberEmail;
use App\ManageText;
use App\ValidationText;
use App\Mail\SendSubscriberMail;
use Mail;
use App\Helpers\MailHelper;
use App\NotificationText;
class SubscriberController extends Controller
{
    public function index(){
        $subscribers=Subscribe::where('status',1)->get();
        $website_lang=ManageText::all();
        return view('admin.subscriber.subscriber.index',compact('subscribers','website_lang'));
    }

    public function delete($id){

            // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        Subscribe::destroy($id);
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');


        return back()->with($notification);
    }

    public function emailTemplate(){
        $template=SubscriberEmail::first();
        $website_lang=ManageText::all();
        return view('admin.subscriber.email.index',compact('template','website_lang'));
    }

    public function sendMail(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end



        $valid_lang=ValidationText::all();
        $rules = [
            'subject'=>'required',
            'message'=>'required',
        ];

        $customMessages = [
            'subject.required' => $valid_lang->where('lang_key','req_subject')->first()->custom_lang,
            'message.required' => $valid_lang->where('lang_key','req_msg')->first()->custom_lang
        ];
        $this->validate($request, $rules, $customMessages);

        $template=SubscriberEmail::first();
        $template->subject=$request->subject;
        $template->message=$request->message;

        $subscribers=Subscribe::where('status',1)->get();

        if($subscribers->count()==0){

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','wrong')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->back()->with($notification);
        }
        foreach($subscribers as $subscriber){
            MailHelper::setMailConfig();
            Mail::to($subscriber->email)->send(new SendSubscriberMail($template));
        }

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','email_send')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');


        return back()->with($notification);
    }
}
