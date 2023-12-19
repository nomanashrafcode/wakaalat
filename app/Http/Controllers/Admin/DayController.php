<?php

namespace App\Http\Controllers\Admin;

use App\Day;
use App\ManageText;
use App\ValidationText;
use App\NotificationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $days=Day::all();
        $website_lang=ManageText::all();
        return view('admin.day.index',compact('days','website_lang'));
    }


    public function update(Request $request, Day $day)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $valid_lang=ValidationText::all();
        $rules = [
            'custom_day'=>'required',
        ];
        $customMessages = [
            'custom_day.required' => $valid_lang->where('lang_key','req_custom_day')->first()->custom_lang


        ];
        $this->validate($request, $rules, $customMessages);


        $day->custom_day=$request->custom_day;
        $day->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.day.index')->with($notification);
    }

}
