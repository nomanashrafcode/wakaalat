<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service;
use App\Lawyer;
use App\Testimonial;
use App\Department;
use App\Blog;
use App\Feature;
use App\Location;
use App\About;
use App\FaqCategory;
use App\BlogCategory;
use App\HomeSection;
use App\Slider;
use App\ContactUs;
use App\ContactInformation;
use App\Work;
use App\WorkFaq;
use App\Schedule;
use App\Day;
use App\BlogComment;
use App\CustomePage;
use App\Subscribe;
use App\ManagePage;
use App\Overview;
use App\Setting;
use App\ConditionPrivacy;
use App\BannerImage;
use App\ManageText;
use App\Navigation;
use App\EmailTemplate;
use App\ValidationText;
use App\NotificationText;
use App\CustomPaginator;
use Str;
use DB;
use App\Mail\SubscribeUsNotification;
use Mail;
use App\Rules\Captcha;
use App\Helpers\MailHelper;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{
    protected $title_meta;
    protected $banner;
    public function __construct(){
        $this->title_meta=ManagePage::first();
        $this->banner=BannerImage::first();
    }

    public function index(){
        $homesections=HomeSection::all();
        $sliders=Slider::where('status',1)->get();
        $features=Feature::where('status',1)->get();
        $blogs=Blog::where('status',1)->orderBy('id','desc')->get();
        $feature_blog=Blog::where('show_feature_blog',1)->orderBy('id','desc')->first();
        $blog_count=Blog::count();
        $departments=Department::where(['show_homepage'=>1,'status'=>1])->get();
        $departmentsForSearch=Department::where('status',1)->orderBy('name','asc')->get();
        $services=Service::where(['show_homepage'=>1,'status'=>1])->get();
        $lawyers=Lawyer::with('department')->where(['show_homepage'=>1,'status'=>1])->get();
        $lawyersForSearch=Lawyer::with('department')->orderBy('name','asc')->where('status',1)->get();
        $testimonials=Testimonial::where(['show_homepage'=>1,'status'=>1])->get();
        $locations=Location::orderBy('location','asc')->where('status',1)->get();
        $work=Work::first();
        $workFaqs=WorkFaq::where('status',1)->get();
        $overviews=Overview::where('status',1)->get();
        $title_meta=$this->title_meta;
        $banner=$this->banner;
        $website_lang=ManageText::all();
        $setting=Setting::first();
        $isRtl=$setting->text_direction;

        return view('client.index',compact('services','blogs','feature_blog','departments','services','lawyers','locations','features','testimonials','lawyersForSearch','departmentsForSearch','homesections','sliders','work','workFaqs','title_meta','overviews','banner','website_lang','blog_count','isRtl'));
    }

    public function aboutUs(){
        $about=About::first();
        $about_count=About::count();
        $title_meta=$this->title_meta;
        $banner=$this->banner;
        $work=Work::first();
        $workFaqs=WorkFaq::where('status',1)->get();
        $overviews=Overview::where('status',1)->get();
        $navigation=Navigation::first();
        return view('client.about',compact('about','title_meta','work','workFaqs','overviews','banner','navigation','about_count'));
    }

    public function Faq(){
        $faqCategories=FaqCategory::with('faqs')->where('status',1)->get();
        $title_meta=$this->title_meta;
        $banner=$this->banner;
        $navigation=Navigation::first();
        return view('client.faq',compact('faqCategories','title_meta','banner','navigation'));
    }

    public function blog(){
        Paginator::useBootstrap();
        $pagination_qty=CustomPaginator::where('id',2)->first()->qty;
        $blogs=Blog::orderBy('id','desc')->where('status',1)->paginate($pagination_qty);
        $title_meta=$this->title_meta;
        $banner=$this->banner;
        $navigation=Navigation::first();
        $website_lang=ManageText::all();
        $setting=Setting::first();
        $isRtl=$setting->text_direction;
        return view('client.blog.index',compact('blogs','title_meta','banner','navigation','website_lang','isRtl'));
    }

    public function blogDetails($slug){
        $blog=Blog::with('comments')->where('slug',$slug)->first();
        if(!$blog) return back();
        $blogCategories=BlogCategory::where('status',1)->orderBy('name','asc')->get();
        $title_meta=$this->title_meta;
        $latestBlog=Blog::where('id','!=',$blog->id)->orderby('id','desc')->get()->take(5);
        $setting=Setting::first();
        $banner=$this->banner;
        $navigation=Navigation::first();
        $website_lang=ManageText::all();
        $isRtl=$setting->text_direction;
        return view('client.blog.show',compact('blog','blogCategories','title_meta','latestBlog','setting','banner','navigation','website_lang','isRtl'));
    }

    public function blogCategory($slug){
        Paginator::useBootstrap();
        $pagination_qty=CustomPaginator::where('id',2)->first()->qty;
        $category=BlogCategory::where('slug',$slug)->first();
        if(!$category) return back();
        $blogs=Blog::where(['blog_category_id'=>$category->id,'status'=>1])->paginate($pagination_qty);
        $title_meta=$this->title_meta;
        $banner=$this->banner;
        $navigation=Navigation::first();
        $website_lang=ManageText::all();
        return view('client.blog.category-blog',compact('category','blogs','title_meta','banner','navigation','website_lang'));
    }

    public function contactUs(){
        $contactUs=ContactInformation::first();
        $title_meta=$this->title_meta;
        $setting=Setting::first();
        $banner=$this->banner;
        $navigation=Navigation::first();
        $website_lang=ManageText::all();
        return view('client.contact-us',compact('contactUs','title_meta','setting','banner','navigation','website_lang'));
    }

    public function lawyer(){
        Paginator::useBootstrap();
        $pagination_qty=CustomPaginator::where('id',1)->first()->qty;
        $departments=Department::orderBy('name','asc')->where('status',1)->get();
        $lawyersForSearch=Lawyer::with('department')->orderBy('name','asc')->where('status',1)->get();
        $lawyers=Lawyer::with('department')->orderBy('name','asc')->where('status',1)->paginate($pagination_qty);
        $locations=Location::orderBy('location','asc')->where('status',1)->get();
        $title_meta=$this->title_meta;
        $banner=$this->banner;
        $navigation=Navigation::first();
        $website_lang=ManageText::all();
        return view('client.lawyer.index',compact('lawyers','departments','locations','lawyersForSearch','title_meta','banner','navigation','website_lang'));
    }

    public function lawyerDetails($slug){
        $lawyer=Lawyer::with('department','location')->where('slug',$slug)->first();
        if(!$lawyer)return back();
        $title_meta=$this->title_meta;
        $currency=Setting::first();
        $banner=$this->banner;
        $navigation=Navigation::first();
        $website_lang=ManageText::all();
        return view('client.lawyer.show',compact('lawyer','title_meta','currency','banner','navigation','website_lang'));
    }


    public function searchLawyer(Request $request){

        Paginator::useBootstrap();
        $pagination_qty=CustomPaginator::where('id',1)->first()->qty;
        $location_id=$request->location;
        $lawyer_id=$request->lawyer;
        $department_id=$request->department;

        $lawyers=Lawyer::orderBy('name','desc');
        if($location_id) $lawyers = $lawyers->where('location_id',$location_id);
        if($department_id) $lawyers = $lawyers->where('department_id',$department_id);
        if($lawyer_id) $lawyers = $lawyers->where('id',$lawyer_id);
        $lawyers=$lawyers->paginate($pagination_qty);
        $lawyers=$lawyers->appends($request->all());
        $departments=Department::orderBy('name','asc')->where('status',1)->get();
        $lawyersForSearch=Lawyer::with('department')->orderBy('name','asc')->where('status',1)->get();
        $locations=Location::orderBy('location','asc')->get();
        $title_meta=$this->title_meta;
        $banner=$this->banner;
        $navigation=Navigation::first();
        $website_lang=ManageText::all();
        return view('client.lawyer.index',compact('lawyers','departments','locations','lawyersForSearch','location_id','lawyer_id','department_id','title_meta','banner','navigation','website_lang'));
    }



    public function department(){
        Paginator::useBootstrap();
        $pagination_qty=CustomPaginator::where('id',3)->first()->qty;
        $departments=Department::where('status',1)->paginate($pagination_qty);
        $title_meta=$this->title_meta;
        $banner=$this->banner;
        $navigation=Navigation::first();
        $website_lang=ManageText::all();
        return view('client.department.index',compact('departments','title_meta','banner','navigation','website_lang'));
    }

    public function departmentDetails($slug){
        $department=Department::with('images','faqs','videos')->where('slug',$slug)->first();
        if(!$department) return back();
        $departments=Department::where('status',1)->get();
        $lawyers=Lawyer::with('location','department')->where('department_id',$department->id)->get();
        $contactInfo=ContactInformation::first();
        $title_meta=$this->title_meta;
        $setting=Setting::first();
        $homesection=HomeSection::where('id',6)->first();
        $description=$homesection->description;
        $banner=$this->banner;
        $navigation=Navigation::first();
        $website_lang=ManageText::all();
        return view('client.department.show',compact('department','departments','lawyers','contactInfo','title_meta','setting','description','banner','navigation','website_lang'));
    }

    public function service(){
        Paginator::useBootstrap();
        $pagination_qty=CustomPaginator::where('id',4)->first()->qty;
        $services=Service::where('status',1)->paginate($pagination_qty);
        $title_meta=$this->title_meta;
        $banner=$this->banner;
        $navigation=Navigation::first();
        $website_lang=ManageText::all();
        $setting=Setting::first();
        $isRtl=$setting->text_direction;
        return view('client.service.index',compact('services','title_meta','banner','navigation','website_lang','isRtl'));
    }

    public function serviceDetails($slug){

        $service=Service::with('images','faqs','videos')->where(['status'=>1,'slug'=>$slug])->first();
        if(!$service)return back();
        $services=Service::where('status',1)->get();
        $contactInfo=ContactInformation::first();
        $title_meta=$this->title_meta;
        $setting=Setting::first();
        $banner=$this->banner;
        $navigation=Navigation::first();
        $website_lang=ManageText::all();
        return view('client.service.show',compact('service','services','contactInfo','title_meta','setting','banner','navigation','website_lang'));
    }

    public function testimonial(){
        Paginator::useBootstrap();
        $pagination_qty=CustomPaginator::where('id',6)->first()->qty;
        $testimonials=Testimonial::where('status',1)->paginate($pagination_qty);
        $title_meta=$this->title_meta;
        $banner=$this->banner;
        $navigation=Navigation::first();
        return view('client.testimonial',compact('testimonials','title_meta','banner','navigation'));
    }

    public function termsCondition(){
        $condition=ConditionPrivacy::first();
        $banner=$this->banner;
        $navigation=Navigation::first();
        $condition_count=ConditionPrivacy::count();
        return view('client.terms-condition',compact('condition','banner','navigation','condition_count'));
    }

    public function privacyPolicy(){
        $condition=ConditionPrivacy::first();
        $banner=$this->banner;
        $navigation=Navigation::first();
        $privacy_count=ConditionPrivacy::count();
        return view('client.privacy-policy',compact('condition','banner','navigation','privacy_count'));
    }


    public function commentStore(Request $request){

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $valid_lang=ValidationText::all();
        $rules = [
            'name'=>'required',
            'email'=>'required|email',
            'comment'=>'required',
            'g-recaptcha-response'=>new Captcha()
        ];

        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','req_name')->first()->custom_lang,
            'email.required' => $valid_lang->where('lang_key','req_email')->first()->custom_lang,
            'comment.required' => $valid_lang->where('lang_key','req_comment')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);


        BlogComment::create([
            'name'=>$request->name,
            'blog_id'=>$request->blog_id,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'comment'=>$request->comment,
        ]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','comment')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');


        return back()->with($notification);
    }

    // manage subsciber
    public function subscribeUs(Request $request){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }


        $valid_lang=ValidationText::all();
        $rules = [
            'email'=>'required|email',
        ];

        $customMessages = [
            'email.required' => $valid_lang->where('lang_key','req_email')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);

        $isSubsriber=Subscribe::where('email',$request->email)->count();
        $notify=NotificationText::first();
        if($isSubsriber ==0){
            $subscribe=Subscribe::create([
                'email'=>$request->email,
                'verify_token'=>Str::random(25)
            ]);

            $template=EmailTemplate::where('id',4)->first();
            $message=$template->description;
            $subject=$template->subject;
            MailHelper::setMailConfig();
            Mail::to($subscribe->email)->send(new SubscribeUsNotification($subscribe,$message,$subject));

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','subscribe')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'success');

            return back()->with($notification);
        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','already_subscribe')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'error');

            return back()->with($notification);
        }

    }

    public function subscriptionVerify($token){
        $subscribe=Subscribe::where('verify_token',$token)->first();
        $notify=NotificationText::first();
        if($subscribe){
            $subscribe->status=1;
            $subscribe->verify_token=null;
            $subscribe->save();

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','subscribe_verified')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'success');

            return redirect()->to('/')->with($notification);
        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','invalid_token')->first()->custom_lang;
            $notification=array('messege'=>$notification,'alert-type'=>'error');

            return redirect()->to('/')->with($notification);
        }
    }


    public function customePage($slug){
        $page=CustomePage::where('slug',$slug)->first();
        $title_meta=$this->title_meta;
        $banner=$this->banner;
        $navigation=Navigation::first();
        return view('client.custom-page',compact('page','title_meta','banner','navigation'));
    }
}
