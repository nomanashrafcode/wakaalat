<?php
namespace App\Http\Controllers\Admin;

use App\Lawyer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Department;
use App\Location;
use App\Mail\LawyerLoginInformation;
use Mail;
use Image;
use File;
use Str;
use Hash;
use App\Setting;
use App\EmailTemplate;
use App\Schedule;
use App\Message;
use App\Appointment;
use App\Helpers\MailHelper;
use App\MeetingHistory;
use App\ZoomMeeting;
use App\ZoomCredential;
use App\ManageText;
use App\ValidationText;
use App\NotificationText;
class LawyerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {

        $lawyers=Lawyer::all();
        $currency=Setting::first();
        $schedules=Schedule::all();
        $messages=Message::all();
        $appointments=Appointment::all();
        $website_lang=ManageText::all();
        return view('admin.lawyer.index',compact('lawyers','currency','schedules','messages','appointments','website_lang'));
    }


    public function create()
    {
        $departments=Department::orderBy('name','asc')->get();
        $locations=Location::orderBy('location','asc')->get();
        $website_lang=ManageText::all();
        return view('admin.lawyer.create',compact('departments','locations','website_lang'));
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
            'name'=>'required',
            'email'=>'required|unique:lawyers',
            'phone'=>'required',
            'password'=>'required',
            'designations'=>'required',
            'image'=>'required',
            'appointment_fee'=>'required',
            'department'=>'required',
            'location'=>'required',
        ];
        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','req_name')->first()->custom_lang,
            'email.required' => $valid_lang->where('lang_key','req_email')->first()->custom_lang,
            'email.unique' => $valid_lang->where('lang_key','unique_email')->first()->custom_lang,
            'phone.required' => $valid_lang->where('lang_key','req_phone')->first()->custom_lang,
            'password.required' => $valid_lang->where('lang_key','req_pass')->first()->custom_lang,
            'designations.required' => $valid_lang->where('lang_key','req_designation')->first()->custom_lang,
            'image.required' => $valid_lang->where('lang_key','req_img')->first()->custom_lang,
            'appointment_fee.required' => $valid_lang->where('lang_key','req_fee')->first()->custom_lang,
            'department.required' => $valid_lang->where('lang_key','req_department')->first()->custom_lang,
            'location.required' => $valid_lang->where('lang_key','req_location')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);


        $image=$request->image;
        $extention=$image->getClientOriginalExtension();
        $name= 'lawyer-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/custom-images/'.$name;
        Image::make($image)
            ->resize(500,null,function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(public_path($image_path));


        $lawyer=Lawyer::create([
                'name'=>$request->name,
                'slug'=>Str::slug($request->name),
                'email'=>$request->email,
                'phone'=>$request->phone,
                'facebook'=>$request->facebook,
                'twitter'=>$request->twitter,
                'linkedin'=>$request->linkedin,
                'password'=>Hash::make($request->password),
                'designations'=>$request->designations,
                'image'=>$image_path,
                'fee'=>$request->appointment_fee,
                'department_id'=>$request->department,
                'location_id'=>$request->location,
                'seo_title'=>$request->seo_title,
                'seo_description'=>$request->seo_description,
                'about'=>$request->about,
                'address'=>$request->address,
                'educations'=>$request->educations,
                'experience'=>$request->experiences,
                'qualifications'=>$request->qualifications,
                'status'=>$request->status,
                'show_homepage'=>$request->show_homepage
            ]);

        $website_lang=ManageText::all();
        $login_here_text=$website_lang->where('lang_key','lawyer_login_here')->first()->custom_lang;

        $template=EmailTemplate::where('id',3)->first();
        $message=$template->description;
        $subject=$template->subject;
        $message=str_replace('{{lawyer_name}}',$lawyer->name,$message);
        $message=str_replace('{{email}}',$lawyer->email,$message);
        $message=str_replace('{{password}}',$request->password,$message);
        MailHelper::setMailConfig();
        Mail::to($lawyer->email)->send(new LawyerLoginInformation($message,$subject,$login_here_text));
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return back()->with($notification);
    }


    public function edit(Lawyer $lawyer)
    {

        $departments=Department::orderBy('name','asc')->get();
        $locations=Location::orderBy('location','asc')->get();
        $website_lang=ManageText::all();
        return view('admin.lawyer.edit',compact('departments','locations','lawyer','website_lang'));
    }


    public function update(Request $request, Lawyer $lawyer)
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
            'email'=>'required|unique:lawyers,email,'.$lawyer->id,
            'phone'=>'required',
            'designations'=>'required',
            'appointment_fee'=>'required',
            'department'=>'required',
            'location'=>'required',
            'status'=>'required',
            'show_homepage'=>'required'
        ];
        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','req_name')->first()->custom_lang,
            'email.required' => $valid_lang->where('lang_key','req_email')->first()->custom_lang,
            'email.unique' => $valid_lang->where('lang_key','unique_email')->first()->custom_lang,
            'phone.required' => $valid_lang->where('lang_key','req_phone')->first()->custom_lang,
            'designations.required' => $valid_lang->where('lang_key','req_designation')->first()->custom_lang,
            'appointment_fee.required' => $valid_lang->where('lang_key','req_fee')->first()->custom_lang,
            'department.required' => $valid_lang->where('lang_key','req_department')->first()->custom_lang,
            'location.required' => $valid_lang->where('lang_key','req_location')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);





        // upload new image
        $image_path=$lawyer->image;
        if($request->image){
            $old_image=$lawyer->image;
            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $name= 'lawyer-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_path='uploads/custom-images/'.$name;
            Image::make($image)
                ->resize(500,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path($image_path));

                if(File::exists(public_path($old_image)))unlink(public_path($old_image));

        }

        Lawyer::where('id',$lawyer->id)->update([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'email'=>$request->email,
            'phone'=>$request->phone,
            'facebook'=>$request->facebook,
            'twitter'=>$request->twitter,
            'linkedin'=>$request->linkedin,
            'designations'=>$request->designations,
            'image'=>$image_path,
            'fee'=>$request->appointment_fee,
            'department_id'=>$request->department,
            'location_id'=>$request->location,
            'seo_title'=>$request->seo_title,
            'seo_description'=>$request->seo_description,
            'about'=>$request->about,
            'address'=>$request->address,
            'educations'=>$request->educations,
            'experience'=>$request->experiences,
            'qualifications'=>$request->qualifications,
            'status'=>$request->status,
            'show_homepage'=>$request->show_homepage
        ]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.lawyer.index')->with($notification);

    }


    public function destroy(Lawyer $lawyer)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        $lawyer_id=$lawyer->id;
        $old_image=$lawyer->image;
        Message::where('lawyer_id',$lawyer_id)->delete();
        MeetingHistory::where('lawyer_id',$lawyer_id)->delete();
        ZoomMeeting::where('lawyer_id',$lawyer_id)->delete();
        ZoomCredential::where('lawyer_id',$lawyer_id)->delete();
        $lawyer->delete();

        if(File::exists(public_path($old_image)))unlink(public_path($old_image));

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.lawyer.index')->with($notification);
    }

     // change lawer status
     public function changeStatus($id){
        $lawyer=Lawyer::find($id);
        if($lawyer->status==1){
            $lawyer->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_lang;
            $message=$notification;
        }else{
            $lawyer->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_lang;
            $message=$notification;
        }
        $lawyer->save();
        return response()->json($message);

    }
}
