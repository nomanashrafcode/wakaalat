<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting;
use App\ManageText;
use App\ValidationText;
use App\NotificationText;
class SliderContentController extends Controller
{
    public function index(){
        $content=Setting::first();
        $website_lang=ManageText::all();
        return view('admin.slider.content.index',compact('content','website_lang'));
    }

    public function update(Request $request,$id){

                // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end



        $valid_lang=ValidationText::all();
        $rules = [
            'slider_heading'=>'required',
            'slider_description'=>'required',
        ];

        $customMessages = [
            'slider_heading.required' => $valid_lang->where('lang_key','req_header')->first()->custom_lang,
            'slider_description.required' => $valid_lang->where('lang_key','req_des')->first()->custom_lang,

        ];
        $this->validate($request, $rules, $customMessages);


        Setting::where('id',$id)->update([
            'slider_heading'=>$request->slider_heading,
            'slider_description'=>$request->slider_description,
        ]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return back()->with($notification);
    }
}
