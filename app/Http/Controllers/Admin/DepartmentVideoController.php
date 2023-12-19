<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Video;
use App\Department;
use App\ManageText;
use App\ValidationText;
use Illuminate\Http\Request;
use App\NotificationText;
class DepartmentVideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $videos=Video::where('video_category',1)->get();
        $departments=Department::all();
        $website_lang=ManageText::all();
        return view('admin.department.video.index',compact('videos','departments','website_lang'));
    }


    public function store(Request $request)
    {
               // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        $this->validate($request,[

        ]);



        $valid_lang=ValidationText::all();
        $rules = [
            'name'=>'required',
            "link"    => "required|array|min:1",
        ];
        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','req_name')->first()->custom_lang,
            'link.required' => $valid_lang->where('lang_key','req_link')->first()->custom_lang,

        ];
        $this->validate($request, $rules, $customMessages);


        foreach($request->link as $item){
            Video::create([
                'video_category'=>1,
                'department_id'=>$request->name,
                'link'=>$item,
            ]);
        }

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.department-video.index')->with($notification);

    }



    public function update(Request $request, $id)
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
            "link"    => "required",
        ];
        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','req_name')->first()->custom_lang,
            'link.required' => $valid_lang->where('lang_key','req_link')->first()->custom_lang,

        ];
        $this->validate($request, $rules, $customMessages);


        Video::where('id',$id)->update([
            'department_id'=>$request->name,
            'link'=>$request->link,
            'status'=>$request->status
        ]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.department-video.index')->with($notification);
    }


    public function destroy($id)
    {
               // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        Video::destroy($id);
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.department-video.index')->with($notification);
    }

    public function changeStatus($id){
        $video=Video::find($id);
        if($video->status==1){
            $video->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_lang;
            $message=$notification;
        }else{
            $video->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_lang;
            $message=$notification;
        }
        $video->save();
        return response()->json($message);

    }
}
