<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting;
use App\ManageText;
use App\ValidationText;
use App\NotificationText;
class SubscriberContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $setting=Setting::first();
        $website_lang=ManageText::all();
        return view('admin.subscriber.content.index',compact('setting','website_lang'));
    }

    public function Update(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end



        $valid_lang=ValidationText::all();
        $rules = [
            'subscribe_heading'=>'required',
            'subscribe_description'=>'required'
        ];

        $customMessages = [
            'subscribe_heading.required' => $valid_lang->where('lang_key','req_header')->first()->custom_lang,
            'subscribe_description.required' => $valid_lang->where('lang_key','req_des')->first()->custom_lang
        ];
        $this->validate($request, $rules, $customMessages);


        Setting::where('id',$id)->update([
            'subscribe_heading'=>$request->subscribe_heading,
            'subscribe_description'=>$request->subscribe_description,
        ]);
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return back()->with($notification);
    }
}
