<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\ManageText;
use App\ValidationText;
use App\NotificationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins=Admin::all();
        $currentAdmin=Auth::guard('admin')->user();
        if($currentAdmin->admin_type==1){
            $website_lang=ManageText::all();
            return view('admin.admin.index',compact('admins','currentAdmin','website_lang'));
        }else{
            return back();
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $website_lang=ManageText::all();
        return view('admin.admin.create',compact('website_lang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ];
        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','req_name')->first()->custom_lang,
            'email.required' => $valid_lang->where('lang_key','req_email')->first()->custom_lang,
            'password.required' => $valid_lang->where('lang_key','req_pass')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);

        $admin=new Admin();
        $admin->name=$request->name;
        $admin->email=$request->email;
        $admin->password=Hash::make($request->password);
        $admin->status=$request->status;
        $admin->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.admin-list.index')->with($notification);
    }




    public function destroy($id)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        Admin::destroy($id);
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.admin-list.index')->with($notification);
    }

    // manage blog status
    public function changeStatus($id){
        $admin=Admin::find($id);
        if($admin->status==1){
            $admin->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_lang;
            $message=$notification;
        }else{
            $admin->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_lang;
            $message=$notification;
        }
        $admin->save();
        return response()->json($message);

    }
}
