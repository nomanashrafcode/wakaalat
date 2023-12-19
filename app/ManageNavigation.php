<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManageNavigation extends Model
{
    protected $fillable=[
        'show_homepage','show_aboutus','show_doctor','show_department','show_service','show_testimonial','show_faq','show_blog','show_contactus'
    ];
}
