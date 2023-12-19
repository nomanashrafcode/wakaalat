<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Appointment;
use App\BannerImage;
use App\Message;
use Auth;
use Pusher\Pusher;
use App\ManageText;
use App\Navigation;
use App\Lawyer;
class MessageController extends Controller
{
    public function index(){
        $user=Auth::guard('web')->user();
        $lawyers=Appointment::with('lawyer')->where('user_id',$user->id)->groupBy('lawyer_id')->select('lawyer_id')->get();
        $banner=BannerImage::first();
        $navigation=Navigation::first();
        $website_lang=ManageText::all();
        return view('client.profile.message.index',compact('user','lawyers','banner','navigation','website_lang'));
    }

    public function messageBox($slug){
        $doctor=Doctor::where('slug',$slug)->first();
        $lawyer_id=$doctor->id;
        $user=Auth::guard('web')->user();
        Message::where(['user_id'=>$user->id,'lawyer_id'=>$lawyer_id])->update(['user_view'=>1]);
        $messages = Message::where(['user_id'=>$user->id,'lawyer_id'=>$lawyer_id])->get();


        $doctors=Appointment::with('doctor')->where('user_id',$user->id)->groupBy('lawyer_id')->select('lawyer_id')->get();
        $banner=BannerImage::first();
        $navigation=Navigation::first();
        $text=ManageText::first();

        return view('client.profile.message.single-message',compact('messages','doctors','banner','navigation','text','user','lawyer_id'));
    }

    public function getMessage($lawyer_id){
        $user=Auth::guard('web')->user();
        $my_id=$user->id;
        Message::where(['user_id'=>$user->id,'lawyer_id'=>$lawyer_id])->update(['user_view'=>1]);
        $messages = Message::where(['user_id'=>$user->id,'lawyer_id'=>$lawyer_id])->get();
        return view('client.profile.message.message-box',compact('messages'));
    }

    public function sendMessage(Request $request){
        $this->validate($request,[
            'receiver_id'=>'required',
            'message'=>'required'
        ]);

        $user=Auth::guard('web')->user();
        Message::create([
            'user_id'=>$user->id,
            'lawyer_id'=>$request->receiver_id,
            'message'=>$request->message,
            'send_user'=>$user->id
        ]);

        return response()->json(['lawyer_id'=>$request->receiver_id]);
    }
}
