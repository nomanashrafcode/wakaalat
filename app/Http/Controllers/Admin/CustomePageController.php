<?php

namespace App\Http\Controllers\Admin;

use App\CustomePage;
use App\ManageText;
use App\ValidationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use App\NotificationText;
class CustomePageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $pages=CustomePage::all();
        $website_lang=ManageText::all();
        return view('admin.custome-page.index',compact('pages','website_lang'));
    }

    public function create()
    {
        $website_lang=ManageText::all();
        return view('admin.custome-page.create',compact('website_lang'));
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
            'description'=>'required',
            'page_name'=>'required',
        ];
        $customMessages = [
            'description.required' => $valid_lang->where('lang_key','req_des')->first()->custom_lang,
            'page_name.required' => $valid_lang->where('lang_key','req_page_name')->first()->custom_lang,

        ];
        $this->validate($request, $rules, $customMessages);


        $page=new CustomePage;
        $page->page_name=$request->page_name;
        $page->slug=Str::slug($request->page_name);
        $page->seo_title=$request->seo_title ? $request->seo_title : 'custom page seo title';
        $page->seo_description=$request->seo_description ? $request->seo_description : 'custom page seo description';
        $page->description=$request->description;
        $page->status=$request->status;
        $page->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');


        return redirect()->route('admin.custom-page.index')->with($notification);
    }




    public function edit($id)
    {

        $page=CustomePage::find($id);
        $website_lang=ManageText::all();
        return view('admin.custome-page.edit',compact('page','website_lang'));
    }


    public function update(Request $request, $id)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }


        $valid_lang=ValidationText::all();
        $rules = [
            'description'=>'required',
            'page_name'=>'required',
        ];
        $customMessages = [
            'description.required' => $valid_lang->where('lang_key','req_des')->first()->custom_lang,
            'page_name.required' => $valid_lang->where('lang_key','req_page_name')->first()->custom_lang,

        ];
        $this->validate($request, $rules, $customMessages);

        $page=CustomePage::find($id);
        $page->page_name=$request->page_name;
        $page->slug=Str::slug($request->page_name);
        $page->seo_title=$request->seo_title ? $request->seo_title : 'custom page seo title';
        $page->seo_description=$request->seo_description ? $request->seo_description : 'custom page seo description';
        $page->description=$request->description;
        $page->status=$request->status;
        $page->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');


        return redirect()->route('admin.custom-page.index')->with($notification);
    }


    public function destroy($id)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        CustomePage::destroy($id);
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');


        return redirect()->route('admin.custom-page.index')->with($notification);
    }

    public function changeStatus($id){
        $page=CustomePage::find($id);
        if($page->status==1){
            $page->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_lang;
            $message=$notification;
        }else{
            $page->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_lang;
            $message=$notification;
        }
        $page->save();
        return response()->json($message);

    }
}
