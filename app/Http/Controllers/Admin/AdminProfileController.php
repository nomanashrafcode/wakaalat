<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Admin;
use App\BannerImage;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
use Image;
use Hash;
use File;

class AdminProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function profile(){
        $admin=Auth::guard('admin')->user();
        $default_profile=BannerImage::first();
        $website_lang=ManageText::all();
        return view('admin.profile.index',compact('admin','default_profile','website_lang'));
    }

    public function updateProfile(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
            }
                // end

        $valid_lang=ValidationText::all();
        $rules = [
            'name'=>'required',
            'email'=>'required',
            'password'=>'confirmed',
        ];

        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','req_name')->first()->custom_lang,
            'email.required' => $valid_lang->where('lang_key','req_email')->first()->custom_lang,
            'password.confirmed' => $valid_lang->where('lang_key','confirm_pass')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);


        $image_name=$request->old_image;
        // inset user profile image
        if($request->file('image')){

            $admin_data=Admin::first();

            if(File::exists(public_path($admin_data->image)))unlink(public_path($admin_data->image));

            $user_image=$request->image;
            $extention=$user_image->getClientOriginalExtension();
            $image_name= $request->name.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name='uploads/website-images/'.$image_name;

            Image::make($user_image)
                ->resize(600,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->crop(400,400)
                ->save(public_path($image_name));

        }

        if($request->password){
            Admin::where('id',Auth::guard('admin')->user()->id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'image'=>$image_name,
                'password'=>Hash::make($request->password)
            ]);
        }else{
            Admin::where('id',Auth::guard('admin')->user()->id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'image'=>$image_name
            ]);
        }


        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.profile')->with($notification);


    }
}
