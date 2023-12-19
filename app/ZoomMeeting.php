<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZoomMeeting extends Model
{
    protected $fillable=[
    'lawyer_id','topic','start_time','duration','meeting_id','password','join_url'
    ];



}
