<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MeetingHistory;
use App\BannerImage;
use App\Navigation;
use App\ManageText;
use Auth;
use Illuminate\Pagination\Paginator;

class MeetingController extends Controller
{
    protected $banner;
    public function __construct()
    {

        $this->middleware('auth:web');
        $this->banner=BannerImage::first();
    }
    public function meetingHistory(){
        Paginator::useBootstrap();
        $user=Auth::guard('web')->user();
        $histories=MeetingHistory::where('user_id',$user->id)->orderBy('meeting_time','desc')->paginate(10);
        $banner=$this->banner;
        $navigation=Navigation::first();
        $website_lang=ManageText::all();
        return view('client.profile.meeting-history',compact('histories','navigation','banner','user','website_lang'));
    }

    public function upCommingMeeting(){
        $user=Auth::guard('web')->user();
        $histories=MeetingHistory::where('user_id',$user->id)->orderBy('meeting_time','desc')->get();
        $banner=$this->banner;
        $navigation=Navigation::first();
        $website_lang=ManageText::all();
        return view('client.profile.upcoming-meeting',compact('histories','navigation','banner','user','website_lang'));
    }
}
