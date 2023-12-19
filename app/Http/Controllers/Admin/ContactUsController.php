<?php

namespace App\Http\Controllers\Admin;

use App\ContactUs;
use App\ContactMessage;
use App\ManageText;
use App\NotificationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $contact=ContactUs::first();
        $website_lang=ManageText::all();
        if($contact){
            return view('admin.contact.contact-us.edit',compact('contact','website_lang'));
        }

    }


    public function store(Request $request)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        $contact=ContactUs::all()->count();
        if($contact==0){
            ContactUs::create([
                'email'=>$request->email,
                'phone'=>$request->phone,
                'facebook'=>$request->facebook,
                'twitter'=>$request->twitter,
                'pinterest'=>$request->pinterest,
                'linkedin'=>$request->linkedin,
                'youtube'=>$request->youtube,
            ]);

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','create')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'success');

            return redirect()->route('admin.contact-us.index')->with($notification);
        }
    }



    public function update(Request $request, $id)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        ContactUs::where('id',$id)->update([
            'email'=>$request->email,
            'phone'=>$request->phone,
            'facebook'=>$request->facebook,
            'twitter'=>$request->twitter,
            'pinterest'=>$request->pinterest,
            'linkedin'=>$request->linkedin,
            'youtube'=>$request->youtube
        ]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.contact-us.index')->with($notification);
    }




    public function message(){
        $messages=ContactMessage::orderBy('id','desc')->get();
        $website_lang=ManageText::all();
        return view('admin.contact.contact-message.index',compact('messages','website_lang'));
    }
}
