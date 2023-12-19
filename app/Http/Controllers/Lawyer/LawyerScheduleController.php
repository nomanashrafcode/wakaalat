<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\ManageText;
class LawyerScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:lawyer');
    }
    public function index(){
        $lawyer=Auth::guard('lawyer')->user();
        $website_lang=ManageText::all();
        return view('lawyer.schedule.index',compact('lawyer','website_lang'));
    }
}
