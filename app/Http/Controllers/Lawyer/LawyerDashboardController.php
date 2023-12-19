<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Appointment;
use App\ManageText;
use App\Setting;
use Carbon\Carbon;
class LawyerDashboardController extends Controller
{

     public function __construct(){
        $this->middleware('auth:lawyer');
    }

    public function index(){
        $lawyer=Auth::guard('lawyer')->user();
        $last_one_year = \Carbon\Carbon::today()->subDays(365);
        $today=date('Y-m-d');
        $appointments=Appointment::where([
            'lawyer_id'=>$lawyer->id,
            'payment_status'=>1,
        ])->get();


        $todayAppointments=Appointment::where([
            'lawyer_id'=>$lawyer->id,
            'already_treated'=>0,
            'payment_status'=>1,
            'date'=>$today
        ])->get();

        $newAppointmentQty=$appointments->where('already_treated',0)->count();
        $successAppointments=$appointments->where('already_treated',1);

         // start manage chart
         $appointmentsForChart=Appointment::where([
            'lawyer_id'=>$lawyer->id,
            'payment_status'=>1
        ])->get();
         $data=array();
         $start = new Carbon('first day of this month');
         $first_date=$start->format('Y-m-d');
         $today=date('Y-m-d');
         $length=date('d')-$start->format('d');
         for($i=1; $i<=$length+1; $i++){

            $date = '';
            if($i==1) $date=$first_date;
            else $date = $start->addDays(1)->format('Y-m-d');

            $sum=Appointment::whereDate('created_at',$date)->where(['payment_status'=>1,'lawyer_id'=>$lawyer->id])->sum('appointment_fee');
            $data[] = $sum;
         }
         // end manage chart
         $data=json_encode($data);
         $currency=Setting::first();
         $website_lang=ManageText::all();
        return view('lawyer.dashboard',compact('newAppointmentQty','successAppointments','todayAppointments','data','appointments','currency','website_lang'));
    }
}
