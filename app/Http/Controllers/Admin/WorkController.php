<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Work;
use App\ManageText;
use App\ValidationText;
use App\NotificationText;
use Illuminate\Http\Request;
use Image;
use File;
class WorkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $work=Work::first();
        $website_lang=ManageText::all();
        if($work){
            return view('admin.work.edit',compact('work','website_lang'));
        }
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
            'image'=>'required',
            'video'=>'required',
            'title'=>'required',
            'description'=>'required',
        ];

        $customMessages = [
            'image.required' => $valid_lang->where('lang_key','req_img')->first()->custom_lang,
            'video.required' => $valid_lang->where('lang_key','req_video')->first()->custom_lang,
            'title.required' => $valid_lang->where('lang_key','req_title')->first()->custom_lang,
            'description.required' => $valid_lang->where('lang_key','req_des')->first()->custom_lang
        ];
        $this->validate($request, $rules, $customMessages);

        $image=$request->image;
        $extention=$image->getClientOriginalExtension();
        $name= 'work-background-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;

        $image_path='uploads/website-images/'.$name;

        Image::make($image)
            ->resize(645,645)
            ->save(public_path($image_path));

        Work::create([
            'image'=>$image_path,
            'video'=>$request->video,
            'title'=>$request->title,
            'description'=>$request->description,
        ]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.work.index')->with($notification);
    }


    public function update(Request $request, Work $work)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $valid_lang=ValidationText::all();
        $rules = [
            'video'=>'required',
            'title'=>'required',
            'description'=>'required',
        ];

        $customMessages = [
            'video.required' => $valid_lang->where('lang_key','req_video')->first()->custom_lang,
            'title.required' => $valid_lang->where('lang_key','req_title')->first()->custom_lang,
            'description.required' => $valid_lang->where('lang_key','req_des')->first()->custom_lang
        ];
        $this->validate($request, $rules, $customMessages);


        if($request->file('image')){
            $old_image=$work->image;
            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $name= 'work-background-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;

            $image_path='uploads/website-images/'.$name;
            Image::make($image)
                ->resize(1000,null,function ($constraint) {
                     $constraint->aspectRatio();
                  })
                  ->crop(645,645)
                  ->save(public_path($image_path));


            Work::where('id',$work->id)->update([
                'image'=>$image_path,
                'video'=>$request->video,
                'title'=>$request->title,
                'description'=>$request->description,
            ]);

            if(File::exists(public_path($old_image)))unlink(public_path($old_image));

        }else{
            Work::where('id',$work->id)->update([
                'video'=>$request->video,
                'title'=>$request->title,
                'description'=>$request->description,
            ]);
        }


        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.work.index')->with($notification);
    }

}
