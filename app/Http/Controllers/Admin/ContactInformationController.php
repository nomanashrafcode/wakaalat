<?php

namespace App\Http\Controllers\Admin;

use App\ContactInformation;
use App\ManageText;
use App\ValidationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\NotificationText;
class ContactInformationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $contact=ContactInformation::first();
        $website_lang=ManageText::all();
        if($contact){
            return view('admin.contact.contact-information.edit',compact('contact','website_lang'));
        }
    }




    public function edit(ContactInformation $contactInformation)
    {
        return back();
    }


    public function update(Request $request, ContactInformation $contactInformation)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        $rules = [
            'header'=>'required',
            'address'=>'required',
            'description'=>'required',
            'about'=>'required',
            'phones'=>'required',
            'emails'=>'required',
            'map_embed_code'=>'required',
            'copyright'=>'required',
        ];
        $customMessages = [
            'header.required' => $valid_lang->where('lang_key','req_header')->first()->custom_lang,
            'address.required' => $valid_lang->where('lang_key','req_address')->first()->custom_lang,
            'description.required' => $valid_lang->where('lang_key','req_des')->first()->custom_lang,
            'about.required' => $valid_lang->where('lang_key','req_about')->first()->custom_lang,
            'phones.required' => $valid_lang->where('lang_key','req_phone')->first()->custom_lang,
            'emails.required' => $valid_lang->where('lang_key','req_email')->first()->custom_lang,
            'map_embed_code.required' => $valid_lang->where('lang_key','req_map')->first()->custom_lang,
            'copyright.required' => $valid_lang->where('lang_key','req_copy')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);


        ContactInformation::where('id',$contactInformation->id)->update([
            'header'=>$request->header,
            'address'=>$request->address,
            'description'=>$request->description,
            'about'=>$request->about,
            'phones'=>$request->phones,
            'emails'=>$request->emails,
            'map_embed_code'=>$request->map_embed_code,
            'copyright'=>$request->copyright,
        ]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.contact-information.index')->with($notification);
    }


}
