<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorSocialLink extends Model
{
    protected $fillable=[
        'doctor_id','social_icon','link','status',
    ];
}
