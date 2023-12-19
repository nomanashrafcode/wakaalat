<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Partner;
use App\ManageText;
use App\ValidationText;
use App\NotificationText;
use Illuminate\Http\Request;
use Image;
use File;
class PartnerController extends Controller
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
        $partners=Partner::all();
        $website_lang=ManageText::all();
        return view('admin.partner.index',compact('partners','website_lang'));
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
        ];

        $customMessages = [
            'image.required' => $valid_lang->where('lang_key','req_img')->first()->custom_lang,

        ];
        $this->validate($request, $rules, $customMessages);

         // save image
         $image=$request->image;
         $extention=$image->getClientOriginalExtension();
         $name= 'partner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
         $image_path='uploads/custom-images/'.$name;

         Image::make($image)
            ->resize(1000,null,function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(public_path($image_path));


        $partner=new Partner();
        $partner->image=$image_path;
        $partner->link=$request->link;
        $partner->status=$request->status;
        $partner->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.partner.index')->with($notification);
    }

    public function update(Request $request, Partner $partner)
    {

              // project demo mode check
              if(env('PROJECT_MODE')==0){
                $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
                return redirect()->back()->with($notification);
            }
            // end

        if($request->image){
            // save image
            $old_image=$partner->image;
            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $name= 'partner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_path='uploads/custom-images/'.$name;

            Image::make($image)
                ->resize(1000,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path($image_path));
                $partner->image=$image_path;
                if(File::exists(public_path($old_image)))unlink(public_path($old_image));

        }
        $partner->link=$request->link;
        $partner->status=$request->status;
        $partner->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.partner.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
        $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
        return redirect()->back()->with($notification);
        }
        // end
        $old_image=$partner->image;
        $partner->delete();

        if(File::exists(public_path($old_image)))unlink(public_path($old_image));


        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.partner.index')->with($notification);
    }

    public function changeStatus($id){
        $partner=Partner::find($id);
        if($partner->status==1){
            $partner->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_lang;
            $message=$notification;
        }else{
            $partner->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_lang;
            $message=$notification;
        }
        $partner->save();
        return response()->json($message);

    }
}
