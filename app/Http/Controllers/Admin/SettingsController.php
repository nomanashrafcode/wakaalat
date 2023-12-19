<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use File;
use Config;
use App\Setting;
use App\ManageNavigation;
use App\About;
use App\Admin;
use App\Appointment;
use App\Blog;
use App\BlogCategory;
use App\BlogComment;

use App\ConditionPrivacy;
use App\ContactInformation;
use App\ContactMessage;
use App\ContactUs;
use App\CustomePage;
use App\Department;
use App\DepartmentFaq;
use App\DepartmentImage;
use App\Lawyer;


use App\Faq;
use App\FaqCategory;
use App\Feature;
use App\Leave;
use App\Location;
use App\ManagePage;
use App\Order;
use App\Overview;
use App\Partner;
use App\ZoomCredential;
use App\ZoomMeeting;
use App\Message;

use App\PaymentAccount;
use App\Schedule;
use App\Service;
use App\ServiceImage;
use App\ServiceFaq;
use App\Slider;
use App\Subscribe;
use App\Testimonial;
use App\User;
use App\Video;
use App\Work;
use App\WorkFaq;
use App\EmailTemplate;
use App\MeetingHistory;
use App\ManageText;
use App\ValidationText;
use App\NotificationText;
use App\Currency;

use Artisan;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index()
    {
        $setting=Setting::first();
        if($setting){
            $website_lang=ManageText::all();
            $currencies = Currency::orderBy('name','asc')->get();
            return view('admin.settings.index',compact('setting','website_lang','currencies'));
        }
    }


    public function update(Request $request, Setting $setting)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        $rules = [
            'email'=>'required',
            'currency_name'=>'required',
            'currency_icon'=>'required',
            'currency_rate'=>'required',
            'prenotification_hour'=>'required',
            'sidebar_header_name'=>'required',
            'sidebar_header_icon'=>'required'
        ];

        $customMessages = [
            'email.required' => $valid_lang->where('lang_key','req_email')->first()->custom_lang,
            'currency_name.required' => $valid_lang->where('lang_key','req_currency_name')->first()->custom_lang,
            'currency_icon.required' => $valid_lang->where('lang_key','req_currency_icon')->first()->custom_lang,
            'currency_rate.required' => $valid_lang->where('lang_key','currency_rate')->first()->custom_lang,
            'prenotification_hour.required' => $valid_lang->where('lang_key','req_pre_notify')->first()->custom_lang,
            'sidebar_header_name.required' => $valid_lang->where('lang_key','req_sidebar_header_name')->first()->custom_lang,
            'sidebar_header_icon.required' => $valid_lang->where('lang_key','req_sidebar_header_icon')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);


        if($request->logo){
            // for logo
            $old_logo=$setting->logo;
            $image=$request->logo;
            $ext=$image->getClientOriginalExtension();
            $logo_name= 'logo-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            $logo_name='uploads/website-images/'.$logo_name;

            $logo=Image::make($image)
                ->save(public_path($logo_name));
            $setting->logo=$logo_name;
            if(File::exists(public_path($old_logo)))unlink(public_path($old_logo));

        }


        if($request->favicon){
            // for favicon
            $old_favicon=$setting->favicon;
            $favicon=$request->favicon;
            $ext=$favicon->getClientOriginalExtension();
            $favicon_name= 'favicon-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            $favicon_name='uploads/website-images/'.$favicon_name;

            Image::make($favicon)
                ->save(public_path($favicon_name));
                $setting->favicon=$favicon_name;
                if(File::exists(public_path($old_favicon)))unlink(public_path($old_favicon));

        }

        $setting->email=$request->email;
        $setting->save_contact_message=$request->save_contact_message;
        $setting->patient_can_register=$request->patient_can_register;
        $setting->text_direction=$request->text_direction;
        $setting->currency_name=$request->currency_name;
        $setting->currency_icon=$request->currency_icon;
        $setting->currency_rate=$request->currency_rate;
        $setting->prenotification_hour=$request->prenotification_hour;
        $setting->timezone=$request->timezone;
        $setting->sidebar_header_icon=$request->sidebar_header_icon;
        $setting->sidebar_header_name=$request->sidebar_header_name;
        $setting->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.settings.index')->with($notification);


    }


    public function blogCommentSetting(){
        $setting=Setting::first();
        $website_lang=ManageText::all();
        return view('admin.settings.blog-comment.index',compact('setting','website_lang'));
    }

    public function updateCommentSetting(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        if($request->comment_type==0){


            $valid_lang=ValidationText::all();
            $rules = [
                'facebook_comment_script'=>'required'
            ];

            $customMessages = [
                'facebook_comment_script.required' => $valid_lang->where('lang_key','req_fb_cmnt')->first()->custom_lang,
            ];
            $this->validate($request, $rules, $customMessages);


        }

        $setting=Setting::first();
        $setting->comment_type=$request->comment_type;
        $setting->facebook_comment_script=$request->facebook_comment_script;
        $setting->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->back()->with($notification);
    }


    public function cookieConsentSetting(){
        $setting=Setting::first();
        $website_lang=ManageText::all();
        return view('admin.settings.cookie-consent.index',compact('setting','website_lang'));
    }

    public function updateCookieConsentSetting(Request $request){
                // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        if($request->allow_cookie_consent==1){


            $valid_lang=ValidationText::all();
            $rules = [
                'cookie_text'=>'required',
                'cookie_button_text'=>'required'
            ];

            $customMessages = [
                'cookie_text.required' => $valid_lang->where('lang_key','req_cookie')->first()->custom_lang,
                'cookie_button_text.required' => $valid_lang->where('lang_key','req_cookie_btn')->first()->custom_lang,
            ];
            $this->validate($request, $rules, $customMessages);

        }

        $setting=Setting::first();
        $setting->allow_cookie_consent=$request->allow_cookie_consent;
        $setting->cookie_text=$request->cookie_text;
        $setting->cookie_button_text=$request->cookie_button_text;
        $setting->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function captchaSetting(){
        $setting=Setting::first();
        $website_lang=ManageText::all();
        return view('admin.settings.google-captcha.index',compact('setting','website_lang'));
    }

    public function updateCaptchaSetting(Request $request){
        // project demo mode check
    if(env('PROJECT_MODE')==0){
        $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
        return redirect()->back()->with($notification);
    }
    // end

        if($request->allow_captcha==1){
            $valid_lang=ValidationText::all();
            $rules = [
                'captcha_key'=>'required',
                'captcha_secret'=>'required',
            ];

            $customMessages = [
                'captcha_key.required' => $valid_lang->where('lang_key','req_captcha_key')->first()->custom_lang,
                'captcha_secret.required' => $valid_lang->where('lang_key','req_captcha_secret')->first()->custom_lang,
            ];
            $this->validate($request, $rules, $customMessages);
        }

        $setting=Setting::first();
        $setting->allow_captcha=$request->allow_captcha;
        $setting->captcha_key=$request->captcha_key;
        $setting->captcha_secret=$request->captcha_secret;
        $setting->save();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->back()->with($notification);
    }

    public function clearDatabase(){
        $website_lang=ManageText::all();
        return view('admin.settings.clear-database.index',compact('website_lang'));
    }

    public function destroyDatabase(){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        Appointment::truncate();
        Blog::truncate();
        BlogCategory::truncate();
        BlogComment::truncate();
        ConditionPrivacy::truncate();
        ContactMessage::truncate();
        CustomePage::truncate();
        Department::truncate();
        DepartmentFaq::truncate();
        DepartmentImage::truncate();
        Lawyer::truncate();
        Faq::truncate();
        FaqCategory::truncate();
        Feature::truncate();
        Leave::truncate();
        Location::truncate();
        Order::truncate();
        Schedule::truncate();
        Service::truncate();
        ServiceImage::truncate();
        ServiceFaq::truncate();
        Subscribe::truncate();
        Testimonial::truncate();
        User::truncate();
        Video::truncate();
        Partner::truncate();
        WorkFaq::truncate();
        Overview::truncate();
        ZoomMeeting::truncate();
        ZoomCredential::truncate();
        Message::truncate();
        MeetingHistory::truncate();




        $folderPath = public_path('uploads/custom-images');
        $response = File::deleteDirectory($folderPath);

        $path = public_path('uploads/custom-images');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);

        }

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','database')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.dashboard')->with($notification);

    }


    public function livechatSetting(){
        $setting=Setting::first();
        $website_lang=ManageText::all();
        return view('admin.settings.live-chat.index',compact('setting','website_lang'));
    }

    public function updateLivechatSetting(Request $request){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        if($request->live_chat==1){
            $valid_lang=ValidationText::all();
            $rules = [
                'livechat_script'=>'required'
            ];

            $customMessages = [
                'livechat_script.required' => $valid_lang->where('lang_key','req_livechat_script')->first()->custom_lang,

            ];
            $this->validate($request, $rules, $customMessages);

        }

        $setting=Setting::first();
        $setting->live_chat=$request->live_chat;
        $setting->livechat_script=$request->livechat_script;
        $setting->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function preloaderSetting(){
        $setting=Setting::first();
        if($setting->preloader_image){
            $website_lang=ManageText::all();
            return view('admin.settings.preloader.index',compact('setting','website_lang'));
        }
    }

    public function preloaderUpdate(Request $request,$id){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $setting=Setting::find($id);
        if($request->preloader_image){

            $old_preloader=$setting->preloader_image;

            $root_path=request()->getHost();
            if($root_path=='127.0.0.1'){
                unlink($old_preloader);
                $ext = $request->file('preloader_image')->extension();
                $final_name = 'preloader_image-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
                $request->file('preloader_image')->move('uploads/website-images/', $final_name);
                $setting->preloader_image='uploads/website-images/'.$final_name;
                $setting->save();
            }else{
                unlink(public_path($old_preloader));
                $ext = $request->file('preloader_image')->extension();
                $final_name = 'preloader_image-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
                $request->file('preloader_image')->move(public_path('uploads/website-images/'), $final_name);
                $setting->preloader_image='uploads/website-images/'.$final_name;
                $setting->save();
            }




        }else{
            $setting->preloader=$request->preloader;
            $setting->save();
        }

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function googleAnalytic(){
        $setting=Setting::first();
        $website_lang=ManageText::all();
        return view('admin.settings.google-analytic.index',compact('setting','website_lang'));
    }

    public function googleAnalyticUpdate(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        if($request->google_analytic==1){

            $valid_lang=ValidationText::all();
            $rules = [
                'google_analytic_code'=>'required'
            ];

            $customMessages = [
                'google_analytic_code.required' => $valid_lang->where('lang_key','req_google_analy')->first()->custom_lang,

            ];
            $this->validate($request, $rules, $customMessages);

        };

        $setting=Setting::first();
        $setting->google_analytic=$request->google_analytic;
        $setting->google_analytic_code=$request->google_analytic_code;
        $setting->save();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function themeColor(){
        $setting=Setting::first();
        $website_lang=ManageText::all();
        return view('admin.settings.theme-color.index',compact('setting','website_lang'));
    }

    public function themeColorUpdate(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $setting=Setting::first();
        $setting->theme_one=$request->theme_one;
        $setting->theme_two=$request->theme_two;
        $setting->save();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function emailTemplate(){
        $templates=EmailTemplate::all();
        $website_lang=ManageText::all();
        return view('admin.settings.email-template.index',compact('templates','website_lang'));
    }

    public function editEmail($id){

        $email=EmailTemplate::find($id);
        $website_lang=ManageText::all();
        if($id==1){
            return view('admin.settings.email-template.reset-edit',compact('email','website_lang'));
        }else if($id==2){
            return view('admin.settings.email-template.contact-edit',compact('email','website_lang'));
        }else if($id==3){
            return view('admin.settings.email-template.lawyer-login-edit',compact('email','website_lang'));
        }else if($id==4){
            return view('admin.settings.email-template.subscribe-edit',compact('email','website_lang'));
        }else if($id==5){
            return view('admin.settings.email-template.verification-edit',compact('email','website_lang'));
        }else if($id==6){
            return view('admin.settings.email-template.order-edit',compact('email','website_lang'));
        }else if($id==7){
            return view('admin.settings.email-template.pre-notification',compact('email','website_lang'));
        }else if($id==8){
            return view('admin.settings.email-template.zoom',compact('email','website_lang'));
        }
    }

    public function updateEmail(Request $request,$id){

                // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $valid_lang=ValidationText::all();
        $rules = [
            'subject'=>'required',
            'description'=>'required',
        ];

        $customMessages = [
            'subject.required' => $valid_lang->where('lang_key','req_subject')->first()->custom_lang,
            'description.required' => $valid_lang->where('lang_key','req_des')->first()->custom_lang,

        ];
        $this->validate($request, $rules, $customMessages);

        EmailTemplate::where('id',$id)->update([
            'subject'=>$request->subject,
            'description'=>$request->description
        ]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.email.template')->with($notification);
    }

    public function database_generate(){


        return view('admin.settings.database_generate');
    }

    public function database_regenerate(){

        // Artisan::call('migrate');
        $new_notify = new NotificationText();
        $new_notify->lang_key = 'setup_zoom_first';
        $new_notify->default_lang = 'Please setup the credentials.';
        $new_notify->custom_lang = 'Please setup the credentials.';
        $new_notify->save();

        $new_text1 = new ManageText();
        $new_text2 = new ManageText();
        $new_text3 = new ManageText();

        $new_text1->lang_key = 'client_id';
        $new_text1->default_lang = 'Client Id';
        $new_text1->custom_lang = 'Client Id';
        $new_text1->save();

        $new_text2->lang_key = 'client_secret';
        $new_text2->default_lang = 'Client Secret';
        $new_text2->custom_lang = 'Client Secret';
        $new_text2->save();

        $notification= 'Database generate successfully';
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
