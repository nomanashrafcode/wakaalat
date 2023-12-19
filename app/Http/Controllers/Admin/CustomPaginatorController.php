<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CustomPaginator;
use App\ManageText;
use App\ValidationText;
use App\NotificationText;

class CustomPaginatorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $website_lang=ManageText::all();
        $paginators=CustomPaginator::all();

        return view('admin.pagination.index',compact('website_lang','paginators'));

    }


    public function update(Request $request){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        foreach($request->qtys as $index => $qty){
            if($request->qtys[$index]==''){
                $notification=array(
                    'messege'=> $valid_lang->where('lang_key','req_all')->first()->custom_lang,
                    'alert-type'=>'error'
                );

                return redirect()->back()->with($notification);
            }



            $paginator=CustomPaginator::find($request->ids[$index]);
            $paginator->qty=$request->qtys[$index];
            $paginator->save();
        }
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return back()->with($notification);
    }
}
