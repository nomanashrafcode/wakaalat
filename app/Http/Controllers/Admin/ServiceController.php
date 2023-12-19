<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service;
use App\ServiceImage;
use App\ManageText;
use App\ValidationText;
use App\NotificationText;
use App\Video;
use App\ServiceFaq;
use Illuminate\Http\Request;
use Image;
use Str;
use File;
class ServiceController extends Controller
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
        $services=Service::all();
        $website_lang=ManageText::all();
        return view('admin.service.index',compact('services','website_lang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $website_lang=ManageText::all();
        return view('admin.service.create',compact('website_lang'));
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
            'header'=>'required|unique:services',
            'icon'=>'required',
            'images'=>'required',
            'sort_description'=>'required',
            'long_description'=>'required',
        ];

        $customMessages = [
            'header.required' => $valid_lang->where('lang_key','req_header')->first()->custom_lang,
            'header.unique' => $valid_lang->where('lang_key','unique_header')->first()->custom_lang,
            'icon.required' => $valid_lang->where('lang_key','req_icon')->first()->custom_lang,
            'images.required' => $valid_lang->where('lang_key','req_img')->first()->custom_lang,
            'sort_description.required' => $valid_lang->where('lang_key','req_short_des')->first()->custom_lang,
            'long_description.required' => $valid_lang->where('lang_key','req_des')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);



        // insert Department
        $service=Service::create([
            'header'=>$request->header,
            'icon'=>$request->icon,
            'slug'=>Str::slug($request->header),
            'seo_title'=>$request->seo_title ? $request->seo_title : 'service seo title',
            'seo_description'=>$request->seo_description ? $request->seo_description : 'service seo description',
            'sort_description'=>$request->sort_description,
            'long_description'=>$request->long_description,
            'status'=>$request->status,
            'show_homepage'=>$request->show_homepage,
        ]);


        // image insert
        foreach($request->images  as $index => $row){
            $ext=$row->getClientOriginalExtension();
            $service_image= 'service-'.date('Y-m-d-h-i-s-').rand(999,9999).$index.'.'.$ext;
            $service_image='uploads/custom-images/'.$service_image;
            Image::make($row)
                ->resize(1000,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path($service_image));

            $isInsert=ServiceImage::create([
                'service_id'=>$service->id,
                'image'=>$service_image,
            ]);
        }


        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.service.index')->with($notification);
    }


    public function edit(Service $service)
    {
        $website_lang=ManageText::all();
        return view('admin.service.edit',compact('service','website_lang'));
    }


    public function update(Request $request, Service $service)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
            }
                // end

        $valid_lang=ValidationText::all();
        $rules = [
            'header'=>'required|unique:services,header,'.$service->id,
            'icon'=>'required',
            'sort_description'=>'required',
            'long_description'=>'required',
        ];

        $customMessages = [
            'header.required' => $valid_lang->where('lang_key','req_header')->first()->custom_lang,
            'header.unique' => $valid_lang->where('lang_key','unique_header')->first()->custom_lang,
            'icon.required' => $valid_lang->where('lang_key','req_icon')->first()->custom_lang,
            'sort_description.required' => $valid_lang->where('lang_key','req_short_des')->first()->custom_lang,
            'long_description.required' => $valid_lang->where('lang_key','req_des')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);


        // update service
        $service->header=$request->header;
        $service->slug=Str::slug($request->header);
        $service->icon=$request->icon;
        $service->seo_title=$request->seo_title ? $request->seo_title : 'service seo title';
        $service->seo_description=$request->seo_description ? $request->seo_description : 'service seo description';
        $service->sort_description=$request->sort_description;
        $service->long_description=$request->long_description;
        $service->status=$request->status;
        $service->show_homepage=$request->show_homepage;
        $service->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.service.index')->with($notification);
    }


    public function destroy(Service $service)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
            }
                // end
        $oldImages=$service->images;
        Video::where('service_id',$service->id)->delete();
        ServiceFaq::where('service_id',$service->id)->delete();
        $service->delete();
        foreach($oldImages as $img){
            if(File::exists(public_path($img->image)))unlink(public_path($img->image));
            $img::destroy($img->id);
        }
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.service.index')->with($notification);

    }

    // change service status
    public function changeStatus($id){
        $service=Service::find($id);
        if($service->status==1){
            $service->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_lang;
            $message=$notification;
        }else{
            $service->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_lang;
            $message=$notification;
        }
        $service->save();
        return response()->json($message);

    }

    // manage services images
    public function images($serviceId){
        $images=ServiceImage::where('service_id',$serviceId)->get();
        $website_lang=ManageText::all();
        return view('admin.service.image',compact('images','serviceId','website_lang'));
    }

    // delete service image
    public function deleteImage($id){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
            }
                // end
        $image=ServiceImage::find($id);
        $small_image=$image->image;
        ServiceImage::destroy($id);

        if(File::exists(public_path($small_image)))unlink(public_path($small_image));

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return back()->with($notification);
    }

    // store images
    public function storeImage(Request $request,$serviceId){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
            }
                // end


        $valid_lang=ValidationText::all();
        $rules = [
            "image"    => "required|array|min:1",
        ];

        $customMessages = [
            'image.required' => $valid_lang->where('lang_key','req_img')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);


        foreach($request->image as $index => $row){
            $extention=$row->getClientOriginalExtension();
            $service_image= 'service-'.date('Y-m-d-h-i-s-').rand(999,9999).$index.'.'.$extention;
            $service_image='uploads/custom-images/'.$service_image;

            Image::make($row)
                ->resize(1000,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path($service_image));


            ServiceImage::create([
                'service_id'=>$serviceId,
                'image'=>$service_image,
            ]);
        }

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return back()->with($notification);
    }
}


