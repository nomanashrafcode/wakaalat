<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Image;
use App\DepartmentImage;
use App\ManageText;
use App\ValidationText;
use App\Lawyer;
use File;
use App\NotificationText;
use App\Video;
use App\DepartmentFaq;
class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $departments=Department::with('images')->get();
        $lawyers=Lawyer::all();
        $website_lang=ManageText::all();
        return view('admin.department.index',compact('departments','lawyers','website_lang'));
    }


    public function create()
    {
        $website_lang=ManageText::all();
        return view('admin.department.create',compact('website_lang'));
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
            'name'=>'required|unique:departments',
            'thumbnail_image'=>'required',
            'description'=>'required',
        ];
        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','req_name')->first()->custom_lang,
            'name.unique' => $valid_lang->where('lang_key','unique_name')->first()->custom_lang,
            'thumbnail_image.required' => $valid_lang->where('lang_key','req_thum_img')->first()->custom_lang,
            'description.required' => $valid_lang->where('lang_key','req_des')->first()->custom_lang
        ];
        $this->validate($request, $rules, $customMessages);


        // for feature image
        $thumbnail_image=$request->thumbnail_image->getClientOriginalExtension();
        $thumbnail_image= 'department-feature-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$thumbnail_image;
        $thumbnail_image='uploads/custom-images/'.$thumbnail_image;

        Image::make($request->thumbnail_image)
            ->resize(1000,null,function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(public_path($thumbnail_image));


        // insert Department
        $department=Department::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'description'=>$request->description,
            'seo_title'=>$request->seo_title ? $request->seo_title : 'service seo title',
            'seo_description'=>$request->seo_description ? $request->seo_description : 'service seo description',
            'status'=>$request->status,
            'thumbnail_image'=>$thumbnail_image,
            'show_homepage'=>$request->show_homepage,
        ]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.department.index')->with($notification);

    }

    public function edit(Department $department)
    {
        $website_lang=ManageText::all();
        return view('admin.department.edit',compact('department','website_lang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $valid_lang=ValidationText::all();
        $rules = [
            'name'=>'required|unique:departments,name,'.$department->id,
            'description'=>'required',
        ];
        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','req_name')->first()->custom_lang,
            'name.unique' => $valid_lang->where('lang_key','unique_name')->first()->custom_lang,
            'description.required' => $valid_lang->where('lang_key','req_des')->first()->custom_lang


        ];
        $this->validate($request, $rules, $customMessages);



        if($request->file('thumbnail_image')){
            $old_thumbnail_image=$department->thumbnail_image;
             // for feature image
            $thumbnail_image=$request->thumbnail_image->getClientOriginalExtension();
            $thumbnail_image= 'department-thumbnail-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$thumbnail_image;
            $thumbnail_image='uploads/custom-images/'.$thumbnail_image;

            Image::make($request->thumbnail_image)
                ->resize(1000,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path($thumbnail_image));


            $department->thumbnail_image=$thumbnail_image;

            if(File::exists(public_path($old_thumbnail_image)))unlink(public_path($old_thumbnail_image));


        }

        $department->name=$request->name;
        $department->slug=Str::slug($request->name);
        $department->description=$request->description;
        $department->seo_title=$request->seo_title ? $request->seo_title : 'department seo title';
        $department->seo_description=$request->seo_description ? $request->seo_description : 'department seo description';
        $department->status=$request->status;
        $department->show_homepage=$request->show_homepage;
        $department->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.department.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $oldImages=$department->images;
        $old_feature_image=$department->thumbnail_image;
        Video::where('department_id',$department->id)->delete();
        DepartmentFaq::where('department_id',$department->id)->delete();
        $department->delete();

        if(File::exists(public_path($old_feature_image)))unlink(public_path($old_feature_image));

        foreach($oldImages as $img){

            if(File::exists(public_path($img->image)))unlink(public_path($img->image));
            $img->destroy($img->id);
        }

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.department.index')->with($notification);
    }


    // change department status
    public function changeStatus($id){
        $department=Department::find($id);
        if($department->status==1){
            $department->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_lang;
            $message=$notification;
        }else{
            $department->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_lang;
            $message=$notification;
        }
        $department->save();
        return response()->json($message);

    }


    // manage department images
    public function images($departmentId){
        $images=DepartmentImage::where('department_id',$departmentId)->get();
        $department=Department::find($departmentId);
        $website_lang=ManageText::all();
        return view('admin.department.image',compact('images','department','website_lang'));
    }

    // store feature images
    public function storeImage(Request $request,$departmentId){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end




        $valid_lang=ValidationText::all();
        $rules = [
            "image" => "required",
        ];
        $customMessages = [
            'image.required' => $valid_lang->where('lang_key','req_img')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);

        foreach($request->image as $index => $row){
            $extention=$row->getClientOriginalExtension();
            $department_image= 'department-'.date('Y-m-d-h-i-s-').rand(999,9999).$index.'.'.$extention;
            $department_image='uploads/custom-images/'.$department_image;

            Image::make($row)
                ->resize(1000,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path($department_image));


            DepartmentImage::create([
                'department_id'=>$departmentId,
                'image'=>$department_image,
            ]);
        }

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return back()->with($notification);
    }

    // insert department thumbnail
    public function thumbnailImage(Request $request,$departmentId){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        if(!$request->file('thumbnail_image')){
            return back()->with(['thumbnail_error'=>'Thumbnail Image is Required']);
        }else{
            $image=$request->thumbnail_image;
            $extention=$image->getClientOriginalExtension();
            $name= 'department-thumbnail-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_path='uploads/custom-images/'.$name;
            Image::make($image)
                ->resize(1000,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path($image_path));

            Department::where('id',$departmentId)->update(['thumbnail_image'=>$image_path]);

            if(File::exists(public_path($request->old_thumbnail)))unlink(public_path($request->old_thumbnail));

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','create')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'success');

            return back()->with($notification);

        }
    }

    // delete department thumbnail image
    public function deleteThumbnail($departmentId){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $department=Department::find($departmentId);
        $thumbnail_image=$department->thumbnail_image;
        Department::where('id',$departmentId)->update(['thumbnail_image'=>null]);

        if(File::exists(public_path($thumbnail_image)))unlink(public_path($thumbnail_image));

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

            return back()->with($notification);
    }

    // delete department image
    public function deleteImage($imageId){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $image=DepartmentImage::find($imageId);
        $img=$image->image;
        DepartmentImage::destroy($imageId);

        if(File::exists(public_path($img)))unlink(public_path($img));

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return back()->with($notification);
    }
}
