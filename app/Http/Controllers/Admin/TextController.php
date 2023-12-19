<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ManageText;
use App\ValidationText;
use App\NotificationText;

class TextController extends Controller
{
    public function index(){
        $manageTexts=ManageText::all();
        $website_lang=ManageText::all();
        return view('admin.manage-text.index',compact('manageTexts','website_lang'));
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
                    'messege'=>$valid_lang->where('lang_key','req_all')->first()->custom_lang,
                    'alert-type'=>'error'
                );

                return redirect()->back()->with($notification);
            }

            $manageText=ManageText::find($request->ids[$index]);
            $manageText->custom_lang=$request->customs[$index];
            $manageText->save();
        }


        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return back()->with($notification);
    }
}
