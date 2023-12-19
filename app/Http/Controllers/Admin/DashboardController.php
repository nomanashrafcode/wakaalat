<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Appointment;
use App\User;
use App\Lawyer;
use App\Subscribe;
use Carbon\Carbon;
use App\Order;
use App\Setting;
use App\ManageText;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){

        // start manage chart
        $data=array();
        $start = new Carbon('first day of this month');
        $last = new Carbon('last day of this month');
        $first_date=$start->format('Y-m-d');
        $last_date=$last->format('Y-m-d');
        $today=date('Y-m-d');
        $length=date('d')-$start->format('d');
        for($i=1; $i<=$length+1; $i++){

            $date = '';
            if($i==1) $date=$first_date;
            else $date = $start->addDays(1)->format('Y-m-d');

            $sum=Appointment::whereDate('created_at',$date)->sum('appointment_fee');
            $data[] = $sum;
        }
        $data=json_encode($data);
        // end manage chart


        $lawyers=Lawyer::where('status',1)->get();
        $lawyerPayments=Appointment::where('payment_status',1)->whereBetween('date', array($first_date, $last_date))->get();


        $pendingOrders=Order::where('payment_status',0)->get()->take(10);
        $newQty=Appointment::where('already_treated',0)->count();


        $successQty=Appointment::where('already_treated',1)->count();
        $patientQty=User::where('status',1)->count();
        $lawyerQty=Lawyer::count();
        $subscriberQty=Subscribe::where('status',1)->count();
        $totalEarning=Appointment::where('payment_status',1)->sum('appointment_fee');
        $lastDayofMonth = \Carbon\Carbon::now()->endOfMonth()->toDateString();
        $monthlyEarning=Appointment::whereBetween('date', array($first_date,$lastDayofMonth))->where('payment_status',1)->sum('appointment_fee');
        $currency=Setting::first();
        $website_lang=ManageText::all();
        return view('admin.dashboard',compact('data','newQty','successQty','patientQty','lawyerQty','totalEarning','subscriberQty','monthlyEarning','pendingOrders','currency','lawyers','lawyerPayments','website_lang'));
    }
}
