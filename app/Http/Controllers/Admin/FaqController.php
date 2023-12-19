<?php

namespace App\Http\Controllers\Admin;

use App\Faq;
use App\FaqCategory;
use App\ManageText;
use App\ValidationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\NotificationText;
class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index($slug)
    {
        $category=FaqCategory::where('slug',$slug)->first();
        $faqs=Faq::where('category_id',$category->id)->get();
        $website_lang=ManageText::all();
        return view('admin.faq.category.faq.index',compact('faqs','category','website_lang'));
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
            'question'=>'required|unique:faqs',
            'answer'=>'required',
            'status'=>'required',
        ];
        $customMessages = [
            'question.required' => $valid_lang->where('lang_key','req_qus')->first()->custom_lang,
            'question.unique' => $valid_lang->where('lang_key','unique_qus')->first()->custom_lang,
            'answer.required' => $valid_lang->where('lang_key','req_ans')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);


        Faq::create([
            'category_id'=>$request->category_id,
            'question'=>$request->question,
            'answer'=>$request->answer,
            'status'=>$request->status,
        ]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return back()->with($notification);
    }



    public function update(Request $request, Faq $faq)
    {
                // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end


        $valid_lang=ValidationText::all();
        $rules = [
            'question'=>'required|unique:faqs,question,'.$faq->id,
            'answer'=>'required'
        ];
        $customMessages = [
            'question.required' => $valid_lang->where('lang_key','req_qus')->first()->custom_lang,
            'question.unique' => $valid_lang->where('lang_key','unique_qus')->first()->custom_lang,
            'answer.required' => $valid_lang->where('lang_key','req_ans')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);


        $faq->question=$request->question;
        $faq->answer=$request->answer;
        $faq->status=$request->status;
        $faq->save();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return back()->with($notification);
    }

    public function destroy(Faq $faq)
    {
                // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        $faq->delete();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return back()->with($notification);
    }

    // change category status
    public function changeStatus($id){
        $faq=Faq::find($id);
        if($faq->status==1){
            $faq->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_lang;
            $message=$notification;
        }else{
            $faq->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_lang;
            $message=$notification;
        }
        $faq->save();
        return response()->json($message);

    }
}
