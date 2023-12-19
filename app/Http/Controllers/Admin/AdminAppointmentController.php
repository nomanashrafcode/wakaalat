<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Appointment;
use App\Setting;
use App\ManageText;
use App\NotificationText;
class AdminAppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function newAppointment(){
        $appointments=Appointment::where(['payment_status'=>1,'already_treated'=>0])->orderBy('id','desc')->get();
        $website_lang=ManageText::all();
        return view('admin.appointment.new',compact('appointments','website_lang'));
    }

    public function allAppointment(){
        $appointments=Appointment::orderBy('id','desc')->get();
        $website_lang=ManageText::all();
        return view('admin.appointment.all',compact('appointments','website_lang'));
    }


    public function show($id){

        $website_lang=ManageText::all();
        $appointment=Appointment::find($id);
        if($appointment){
            if($appointment->already_treated==1){
                $setting=Setting::first();
                $isRtl=$setting->text_direction;
                return view('admin.appointment.show',compact('appointment','setting','website_lang','isRtl'));
            }else{
                $notify_lang=NotificationText::all();
                $notification=$notify_lang->where('lang_key','wrong')->first()->custom_lang;
                $notification=array('messege'=>$notification,'alert-type'=>'error');


                return redirect()->route('admin.all.appointment')->with($notification);
            }
        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','wrong')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('admin.all.appointment')->with($notification);
        }

    }


    public function downloadFile($file){
        $filepath= public_path() . "/uploads/custom-images/".$file;
        return response()->download($filepath);
    }

}
