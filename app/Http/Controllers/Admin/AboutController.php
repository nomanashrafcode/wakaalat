<?php

namespace App\Http\Controllers\Admin;

use App\About;
use App\ManageText;
use App\ValidationText;
use App\NotificationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use File;
class AboutController extends Controller
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
        $about=About::first();
        if($about){
            $website_lang=ManageText::all();
            return view('admin.about.edit',compact('about','website_lang'));
        }

    }





    public function edit(About $about)
    {
        return back();
    }

    public function updateAbout(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        $rules = [
            'about_description'=>'required'
        ];
        $customMessages = [
            'about_description.required' => $valid_lang->where('lang_key','req_about_des')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);


        if($request->file('image')){
            //    manage about image
            $about_image=$request->image;
            $about_extention=$about_image->getClientOriginalExtension();
            $about_name= 'about-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$about_extention;
            $about_path='uploads/website-images/'.$about_name;

            Image::make($about_image)
                ->resize(900,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->crop(425,425)
                ->save(public_path($about_path));



            About::where('id',$id)->update([
                'about_image'=>$about_path,
            ]);
            if(File::exists(public_path($request->old_about_image)))unlink(public_path($request->old_about_image));

        }
        if($request->file('background_image')){
            //    manage about image
            $background_image=$request->background_image;
            $about_extention=$background_image->getClientOriginalExtension();
            $about_name= 'about-background-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$about_extention;
            $bg_path='uploads/website-images/'.$about_name;

            Image::make($background_image)
                    ->resize(900,null,function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->crop(480,480)
                    ->save(public_path($bg_path));


            About::where('id',$id)->update([
                'background_image'=>$bg_path,
            ]);

            if(File::exists(public_path($request->old_background_image)))unlink(public_path($request->old_background_image));

        }

        About::where('id',$id)->update([
            'about_description'=>$request->about_description
        ]);


        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.about.index')->with($notification);
    }


    public function updateMission(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        $rules = [
            'mission_description'=>'required',
        ];
        $customMessages = [
            'mission_description.required' => $valid_lang->where('lang_key','req_mission_des')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);


        if($request->file('image')){
            //    manage mission image
            $mission_image=$request->image;
            $mission_extention=$mission_image->getClientOriginalExtension();
            $mission_name= 'mission-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$mission_extention;
            $mission_path='uploads/website-images/'.$mission_name;

            Image::make($mission_image)
                ->resize(900,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->crop(525,452)
                ->save(public_path($mission_path));



            About::where('id',$id)->update([
                'mission_image'=>$mission_path,
                'mission_description'=>$request->mission_description
            ]);

            if(File::exists(public_path($request->old_mission_image)))unlink(public_path($request->old_mission_image));

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'success');

            return redirect()->route('admin.about.index')->with($notification);
        }else {
            About::where('id',$id)->update([
                'mission_description'=>$request->mission_description
            ]);
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'success');

            return redirect()->route('admin.about.index')->with($notification);
        }
    }

    public function updateVision(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $valid_lang=ValidationText::all();
        $rules = [
            'vision_description'=>'required',
        ];
        $customMessages = [
            'vision_description.required' => $valid_lang->where('lang_key','req_vision_des')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);

        if($request->file('image')){
            //    manage mission image
            $vision_image=$request->image;
            $vision_extention=$vision_image->getClientOriginalExtension();
            $vision_name= 'mission-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$vision_extention;
            $vision_path='uploads/website-images/'.$vision_name;


            Image::make($vision_image)
                ->resize(900,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->crop(525,452)
                ->save(public_path($vision_path));


            About::where('id',$id)->update([
                'vision_image'=>$vision_path,
                'vision_description'=>$request->vision_description
            ]);


            if(File::exists(public_path($request->old_vision_image)))unlink(public_path($request->old_vision_image));

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'success');

            return redirect()->route('admin.about.index')->with($notification);
        }else {
            About::where('id',$id)->update([
                'vision_description'=>$request->vision_description
            ]);
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'success');

            return redirect()->route('admin.about.index')->with($notification);
        }
    }

}
