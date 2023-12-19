<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ManagePage;
use App\ManageNavigation;
use App\ManageText;
use App\ValidationText;
use App\NotificationText;
class ManagePageController extends Controller
{
    protected $page;
    protected $navigation;
    public function __construct(){
        $this->middleware('auth:admin');
        $this->page=ManagePage::first();
        $this->navigation=ManageNavigation::first();
    }

    public function homePage(){
        $navigation= $this->navigation;
        $page=$this->page;
        $website_lang=ManageText::all();
        return view('admin.pages.home',compact('page','navigation','website_lang'));
    }

    public function homePageUpdate(Request $request){

                // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        $rules = [
            'home_title'=>'required',
            'home_meta_description'=>'required',
            'show_navbar'=>'required'
        ];
        $customMessages = [
            'home_title.required' => $valid_lang->where('lang_key','req_title')->first()->custom_lang,
            'home_meta_description.required' => $valid_lang->where('lang_key','req_meta_des')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);


        // update homepage title or description
        ManagePage::where('id',$this->page->id)->update([
            'home_title'=>$request->home_title,
            'home_meta_description'=>$request->home_meta_description,
        ]);
        // update home navbar status
        ManageNavigation::where('id',$this->navigation->id)->update(['show_homepage'=>$request->show_navbar]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.home.page')->with($notification);
    }

    public function aboutUs(){
        $navigation= $this->navigation;
        $page=$this->page;
        $website_lang=ManageText::all();
        return view('admin.pages.about-us',compact('page','navigation','website_lang'));
    }

    public function aboutUsUpdate(Request $request){

                // project demo mode check
if(env('PROJECT_MODE')==0){
    $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
    return redirect()->back()->with($notification);
}
// end



        $valid_lang=ValidationText::all();
        $rules = [
            'aboutus_title'=>'required',
            'aboutus_meta_description'=>'required',
            'show_navbar'=>'required'
        ];
        $customMessages = [
            'aboutus_title.required' => $valid_lang->where('lang_key','req_title')->first()->custom_lang,
            'aboutus_meta_description.required' => $valid_lang->where('lang_key','req_meta_des')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);

        // update about us title or description
        ManagePage::where('id',$this->page->id)->update([
            'aboutus_title'=>$request->aboutus_title,
            'aboutus_meta_description'=>$request->aboutus_meta_description,
        ]);
        // update about us navbar status
        ManageNavigation::where('id',$this->navigation->id)->update(['show_aboutus'=>$request->show_navbar]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.aboutus.page')->with($notification);
    }

    public function lawyer(){
        $navigation= $this->navigation;
        $page=$this->page;
        $website_lang=ManageText::all();
        return view('admin.pages.lawyer',compact('page','navigation','website_lang'));
    }

    public function lawyerUpdate(Request $request){

                // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $valid_lang=ValidationText::all();
        $rules = [
            'lawyer_title'=>'required',
            'lawyer_meta_description'=>'required',
            'show_navbar'=>'required'
        ];
        $customMessages = [
            'lawyer_title.required' => $valid_lang->where('lang_key','req_title')->first()->custom_lang,
            'lawyer_meta_description.required' => $valid_lang->where('lang_key','req_meta_des')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);


        // update lawyer title or description
        ManagePage::where('id',$this->page->id)->update([
            'lawyer_title'=>$request->lawyer_title,
            'lawyer_meta_description'=>$request->lawyer_meta_description,
        ]);
        // update lawyer navbar status
        ManageNavigation::where('id',$this->navigation->id)->update(['show_lawyer'=>$request->show_navbar]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.lawyer-page')->with($notification);
    }

    public function department(){
        $navigation= $this->navigation;
        $page=$this->page;
        $website_lang=ManageText::all();
        return view('admin.pages.department',compact('page','navigation','website_lang'));
    }

    public function departmentUpdate(Request $request){
                // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        $rules = [
            'department_title'=>'required',
            'department_meta_description'=>'required',
            'show_navbar'=>'required'
        ];
        $customMessages = [
            'department_title.required' => $valid_lang->where('lang_key','req_title')->first()->custom_lang,
            'department_meta_description.required' => $valid_lang->where('lang_key','req_meta_des')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);



        // update department title or description
        ManagePage::where('id',$this->page->id)->update([
            'department_title'=>$request->department_title,
            'department_meta_description'=>$request->department_meta_description,
        ]);
        // update department navbar status
        ManageNavigation::where('id',$this->navigation->id)->update(['show_department'=>$request->show_navbar]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.department-page')->with($notification);
    }

    public function service(){
        $navigation= $this->navigation;
        $page=$this->page;
        $website_lang=ManageText::all();
        return view('admin.pages.service',compact('page','navigation','website_lang'));
    }

    public function serviceUpdate(Request $request){
                // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        $rules = [
            'service_title'=>'required',
            'service_meta_description'=>'required',
            'show_navbar'=>'required'
        ];
        $customMessages = [
            'service_title.required' => $valid_lang->where('lang_key','req_title')->first()->custom_lang,
            'service_meta_description.required' => $valid_lang->where('lang_key','req_meta_des')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);

        // update service title or description
        ManagePage::where('id',$this->page->id)->update([
            'service_title'=>$request->service_title,
            'service_meta_description'=>$request->service_meta_description,
        ]);
        // update service navbar status
        ManageNavigation::where('id',$this->navigation->id)->update(['show_service'=>$request->show_navbar]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.service-page')->with($notification);
    }

    public function testimonial(){
        $navigation= $this->navigation;
        $page=$this->page;
        $website_lang=ManageText::all();
        return view('admin.pages.testimonial',compact('page','navigation','website_lang'));
    }

    public function testimonialUpdate(Request $request){
                // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $valid_lang=ValidationText::all();
        $rules = [
            'testimonial_title'=>'required',
            'testimonial_meta_description'=>'required',
            'show_navbar'=>'required'
        ];
        $customMessages = [
            'testimonial_title.required' => $valid_lang->where('lang_key','req_title')->first()->custom_lang,
            'testimonial_meta_description.required' => $valid_lang->where('lang_key','req_meta_des')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);



        // update testimonial title or description
        ManagePage::where('id',$this->page->id)->update([
            'testimonial_title'=>$request->testimonial_title,
            'testimonial_meta_description'=>$request->testimonial_meta_description,
        ]);
        // update testimonial navbar status
        ManageNavigation::where('id',$this->navigation->id)->update(['show_testimonial'=>$request->show_navbar]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.testimonial.page')->with($notification);
    }

    public function faq(){
        $navigation= $this->navigation;
        $page=$this->page;
        $website_lang=ManageText::all();
        return view('admin.pages.faq',compact('page','navigation','website_lang'));
    }

    public function faqUpdate(Request $request){
                // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        $rules = [
            'faq_title'=>'required',
            'faq_meta_description'=>'required',
            'show_navbar'=>'required'
        ];
        $customMessages = [
            'faq_title.required' => $valid_lang->where('lang_key','req_title')->first()->custom_lang,
            'faq_meta_description.required' => $valid_lang->where('lang_key','req_meta_des')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);


        // update faq title or description
        ManagePage::where('id',$this->page->id)->update([
            'faq_title'=>$request->faq_title,
            'faq_meta_description'=>$request->faq_meta_description,
        ]);
        // update faq navbar status
        ManageNavigation::where('id',$this->navigation->id)->update(['show_faq'=>$request->show_navbar]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.faq.page')->with($notification);
    }

    public function blog(){
        $navigation= $this->navigation;
        $page=$this->page;
        $website_lang=ManageText::all();
        return view('admin.pages.blog',compact('page','navigation','website_lang'));
    }

    public function blogUpdate(Request $request){
                // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $valid_lang=ValidationText::all();
        $rules = [
            'blog_title'=>'required',
            'blog_meta_description'=>'required',
            'show_navbar'=>'required'
        ];
        $customMessages = [
            'blog_title.required' => $valid_lang->where('lang_key','req_title')->first()->custom_lang,
            'blog_meta_description.required' => $valid_lang->where('lang_key','req_meta_des')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);

        // update blog title or description
        ManagePage::where('id',$this->page->id)->update([
            'blog_title'=>$request->blog_title,
            'blog_meta_description'=>$request->blog_meta_description,
        ]);
        // update blog navbar status
        ManageNavigation::where('id',$this->navigation->id)->update(['show_blog'=>$request->show_navbar]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.blog.page')->with($notification);
    }

    public function contactUs(){
        $navigation= $this->navigation;
        $page=$this->page;
        $website_lang=ManageText::all();
        return view('admin.pages.contact',compact('page','navigation','website_lang'));
    }

    public function contactUsUpdate(Request $request){
                // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $valid_lang=ValidationText::all();
        $rules = [
            'contactus_title'=>'required',
            'contactus_meta_description'=>'required',
            'show_navbar'=>'required'
        ];
        $customMessages = [
            'contactus_title.required' => $valid_lang->where('lang_key','req_title')->first()->custom_lang,
            'contactus_meta_description.required' => $valid_lang->where('lang_key','req_meta_des')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);

        // update contact title or description
        ManagePage::where('id',$this->page->id)->update([
            'contactus_title'=>$request->contactus_title,
            'contactus_meta_description'=>$request->contactus_meta_description,
        ]);
        // update contact navbar status
        ManageNavigation::where('id',$this->navigation->id)->update(['show_contactus'=>$request->show_navbar]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.contactus.page')->with($notification);
    }
}
