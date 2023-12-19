<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ServiceFaq;
use App\ManageText;
use App\ValidationText;
use App\NotificationText;
use Illuminate\Http\Request;

class ServiceFaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function faqByService($id)
    {
        $faqs=ServiceFaq::with('service')->where('service_id',$id)->get();
        $website_lang=ManageText::all();
        return view('admin.faq.service.index',compact('faqs','id','website_lang'));
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
            'question'=>'required',
            'answer'=>'required',
        ];

        $customMessages = [
            'question.required' => $valid_lang->where('lang_key','req_qus')->first()->custom_lang,
            'answer.required' => $valid_lang->where('lang_key','req_ans')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);

        ServiceFaq::create([
            'service_id'=>$request->service_id,
            'question'=>$request->question,
            'answer'=>$request->answer,
            'status'=>$request->status,
        ]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.faq.by.service',$request->service_id)->with($notification);
    }


    public function update(Request $request, $id)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
            }
                // end

        $valid_lang=ValidationText::all();
        $rules = [
            'question'=>'required',
            'answer'=>'required',
        ];

        $customMessages = [
            'question.required' => $valid_lang->where('lang_key','req_qus')->first()->custom_lang,
            'answer.required' => $valid_lang->where('lang_key','req_ans')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);


        ServiceFaq::where('id',$id)->update([
            'service_id'=>$request->service_id,
            'question'=>$request->question,
            'answer'=>$request->answer,
            'status'=>$request->status,
        ]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.faq.by.service',$request->service_id)->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ServiceFaq  $serviceFaq
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
            }
                // end

        $service=ServiceFaq::find($id);
        ServiceFaq::destroy($id);
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.faq.by.service',$service->service_id)->with($notification);
    }


    public function changeStatus($id){
        $faq=ServiceFaq::find($id);
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
