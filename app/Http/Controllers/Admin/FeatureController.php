<?php

namespace App\Http\Controllers\Admin;

use App\Feature;
use App\ManageText;
use App\ValidationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use File;
use App\NotificationText;
class FeatureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $features=Feature::all();
        $website_lang=ManageText::all();
        return view('admin.feature.index',compact('features','website_lang'));
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
            'title'=>'required|unique:features',
            'background_image'=>'required',
            'logo'=>'required',
            'description'=>'required',
        ];
        $customMessages = [
            'title.required' => $valid_lang->where('lang_key','req_title')->first()->custom_lang,
            'title.unique' => $valid_lang->where('lang_key','unique_title')->first()->custom_lang,
            'background_image.required' => $valid_lang->where('lang_key','req_img')->first()->custom_lang,
            'logo.required' => $valid_lang->where('lang_key','req_logo')->first()->custom_lang,
            'description.required' => $valid_lang->where('lang_key','req_des')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);


        // save image
        $background_image=$request->background_image;
        $extention=$background_image->getClientOriginalExtension();
        $name= 'feature-bg-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/custom-images/'.$name;
        Image::make($background_image)
        ->save(public_path($image_path));

        Feature::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'background_image'=>$image_path,
            'logo'=>$request->logo,
            'status'=>$request->status
        ]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.feature.index')->with($notification);

    }


    public function update(Request $request, Feature $feature)
    {
                // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $valid_lang=ValidationText::all();
        $rules = [
            'title'=>'required|unique:features,title,'.$feature->id,
            'logo'=>'required',
            'description'=>'required',
            'status'=>'required',
        ];
        $customMessages = [
            'title.required' => $valid_lang->where('lang_key','req_title')->first()->custom_lang,
            'title.unique' => $valid_lang->where('lang_key','unique_title')->first()->custom_lang,
            'logo.required' => $valid_lang->where('lang_key','req_logo')->first()->custom_lang,
            'description.required' => $valid_lang->where('lang_key','req_des')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);



        if($request->file('background_image')){
             // save image
            $old_image=$feature->background_image;
            $background_image=$request->background_image;
            $extention=$background_image->getClientOriginalExtension();
            $name= 'featur-bg-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_path='uploads/custom-images/'.$name;

            Image::make($background_image)
                    ->save(public_path($image_path));
            $feature->background_image=$image_path;
            if(File::exists(public_path($old_image)))unlink(public_path($old_image));


        }

        // insert database
        $feature->title=$request->title;
        $feature->description=$request->description;
        $feature->logo=$request->logo;
        $feature->status=$request->status;
        $feature->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.feature.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feature $feature)
    {
                // project demo mode check
if(env('PROJECT_MODE')==0){
    $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
    return redirect()->back()->with($notification);
}
// end
        $old_image=$feature->background_image;
        $feature->delete();

        if(File::exists(public_path($old_image)))unlink(public_path($old_image));

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.feature.index')->with($notification);

    }


    public function changeStatus($id){
        $feature=Feature::find($id);
        if($feature->status==1){
            $feature->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_lang;
            $message=$notification;
        }else{
            $feature->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_lang;
            $message=$notification;
        }
        $feature->save();
        return response()->json($message);

    }
}
