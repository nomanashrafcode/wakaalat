<?php

namespace App\Http\Controllers\Admin;

use App\HomeSection;
use App\ManageText;
use App\ValidationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\NotificationText;
class HomeSectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $sections=HomeSection::all();
        $website_lang=ManageText::all();
        return view('admin.home-section.home-section',compact('sections','website_lang'));
    }



    public function edit(HomeSection $homeSection)
    {
        return view('admin.home-section.edit',compact('homeSection'));
    }


    public function update(Request $request, HomeSection $homeSection)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        $rules = [
            'first_header'=>$request->section_type==1 ? 'nullable' : 'required',
            'second_header'=>$request->section_type==1 ? 'nullable' : 'required',
            'description'=>$request->section_type==1 ? 'nullable' : 'required',
            'content_quantity'=>$request->section_type==2 ? 'nullable' : 'required',
        ];
        $customMessages = [
            'first_header.required' => $valid_lang->where('lang_key','req_first_header')->first()->custom_lang,
            'second_header.required' => $valid_lang->where('lang_key','req_second_header')->first()->custom_lang,
            'description.required' => $valid_lang->where('lang_key','req_des')->first()->custom_lang,
            'content_quantity.required' => $valid_lang->where('lang_key','req_content_qty')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);

        $homeSection->first_header=$request->first_header;
        $homeSection->second_header=$request->second_header;
        $homeSection->description=$request->description;
        $homeSection->content_quantity=$request->content_quantity;
        $homeSection->show_homepage=$request->show_homepage;
        $homeSection->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.home-section.index')->with($notification);


    }



    public function changeStatus($id){
        $section=HomeSection::find($id);
        if($section->show_homepage==1){
            $section->show_homepage=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_lang;
            $message=$notification;
        }else{
            $section->show_homepage=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_lang;
            $message=$notification;
        }
        $section->save();
        return response()->json($message);

    }
}
