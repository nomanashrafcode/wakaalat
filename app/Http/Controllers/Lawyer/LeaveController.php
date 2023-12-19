<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use App\Leave;
use App\ManageText;
use App\ValidationText;
use Illuminate\Http\Request;
use Auth;
use App\NotificationText;
class LeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:lawyer');
    }

    public function index()
    {   $leaves=Leave::where('lawyer_id',Auth::guard('lawyer')->user()->id)->get();
        $website_lang=ManageText::all();
        return view('lawyer.leave.index',compact('leaves','website_lang'));
    }


    public function store(Request $request)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $valid_lang=ValidationText::all();
        $rules = [
            'date'=>'required'
        ];

        $customMessages = [
            'date.required' => $valid_lang->where('lang_key','req_date')->first()->custom_lang,

        ];
        $this->validate($request, $rules, $customMessages);

        $lawyer=Auth::guard('lawyer')->user()->id;
        $date= date('Y-m-d',strtotime($request->date)) ;
        $exist=Leave::where(['date'=>$date,'lawyer_id'=>$lawyer])->count();
        if($exist ==0){
            Leave::create(['date'=>$date,'lawyer_id'=>$lawyer]);
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','create')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'success');

            return redirect()->route('lawyer.leave.index')->with($notification);
        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','wrong')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'success');

            return redirect()->route('lawyer.leave.index')->with($notification);
        }


    }


    public function update(Request $request, Leave $leave)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        $valid_lang=ValidationText::all();
        $rules = [
            'date'=>'required'
        ];

        $customMessages = [
            'date.required' => $valid_lang->where('lang_key','req_date')->first()->custom_lang,

        ];
        $this->validate($request, $rules, $customMessages);

        Leave::where('id',$leave->id)->update(['date'=>$request->date]);
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('lawyer.leave.index')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {
        // project demo mode check
    if(env('PROJECT_MODE')==0){
        $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
        return redirect()->back()->with($notification);
    }
    // end
        $leave->delete();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('lawyer.leave.index')->with($notification);
    }
}
