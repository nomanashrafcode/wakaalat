<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DepartmentFaq;
use App\ManageText;
use App\ValidationText;
use App\NotificationText;
class DepartmentFaqController extends Controller
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
    public function faqByDepartment($id)
    {
        $faqs=DepartmentFaq::with('department')->where('department_id',$id)->get();
        $website_lang=ManageText::all();
        return view('admin.faq.department.index',compact('faqs','id','website_lang'));
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
            'question'=>'required|unique:department_faqs',
            'answer'=>'required',
            'status'=>'required',
        ];
        $customMessages = [
            'question.required' => $valid_lang->where('lang_key','req_qus')->first()->custom_lang,
            'question.unique' => $valid_lang->where('lang_key','unique_qus')->first()->custom_lang,
            'answer.required' => $valid_lang->where('lang_key','req_ans')->first()->custom_lang,
            'status.required' => $valid_lang->where('lang_key','req_status')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);

        DepartmentFaq::create([
            'department_id'=>$request->department_id,
            'question'=>$request->question,
            'answer'=>$request->answer,
            'status'=>$request->status,
        ]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.faq.by.department',$request->department_id)->with($notification);
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
            'question'=>'required|unique:department_faqs,question,'.$id,
            'answer'=>'required',
            'status'=>'required',
        ];
        $customMessages = [
            'question.required' => $valid_lang->where('lang_key','req_qus')->first()->custom_lang,
            'question.unique' => $valid_lang->where('lang_key','unique_qus')->first()->custom_lang,
            'answer.required' => $valid_lang->where('lang_key','req_ans')->first()->custom_lang,
            'status.required' => $valid_lang->where('lang_key','req_status')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);


        DepartmentFaq::where('id',$id)->update([
            'department_id'=>$request->department_id,
            'question'=>$request->question,
            'answer'=>$request->answer,
            'status'=>$request->status,
        ]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.faq.by.department',$request->department_id)->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
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
        $department=DepartmentFaq::find($id);
        DepartmentFaq::destroy($id);
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.faq.by.department',$department->department_id)->with($notification);
    }

    // change department faq status
    public function changeStatus($id){
        $faq=DepartmentFaq::find($id);
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
