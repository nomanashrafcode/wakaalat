<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    protected $fillable=[
        'home_name','about_us','pages','department','doctor','service','testimonial','faq','contact_us','appointment','dashboard','payment','login','register','show_home','show_aboutus','show_pages','show_department','show_doctor','show_service','show_testimonial','show_faq','show_contactus','show_appointment','show_dashboard','show_payment','show_login','show_register','blog',
        'show_blog','terms_and_condition',
        'show_terms_and_condition',
        'privacy_policy',
        'show_privacy_policy','forget_password','reset_password'
    ];
}
