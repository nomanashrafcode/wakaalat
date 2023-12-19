<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ValidationText;
use App\NotificationText;
use App\ManageText;
class ValidationTextController extends Controller
{
    public function index(){
        $validation_texts=ValidationText::get();
        $website_lang=ManageText::all();
        return view('admin.validation-text.index',compact('validation_texts','website_lang'));
    }

    public function update(Request $request){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        foreach($request->customs as $index => $custom){
            if($request->customs[$index]==''){
                $notification=array(
                    'messege'=> $valid_lang->where('lang_key','req_all')->first()->custom_lang,
                    'alert-type'=>'error'
                );

                return redirect()->back()->with($notification);
            }

            $validation_text=ValidationText::find($request->ids[$index]);
            $validation_text->custom_lang=$request->customs[$index];
            $validation_text->save();
        }
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return back()->with($notification);
    }

    public function notification(){
        $notification_texts=NotificationText::get();
        $website_lang=ManageText::all();
        return view('admin.notification-text.index',compact('notification_texts','website_lang'));
    }

    public function updateNotification(Request $request){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        foreach($request->customs as $index => $custom){
            if($request->customs[$index]==''){
                $notification=array(
                    'messege'=> $valid_lang->where('lang_key','req_all')->first()->custom_lang,
                    'alert-type'=>'error'
                );

                return redirect()->back()->with($notification);
            }

            $notification_text=NotificationText::find($request->ids[$index]);
            $notification_text->custom_lang=$request->customs[$index];
            $notification_text->save();
        }

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return back()->with($notification);
    }
}
