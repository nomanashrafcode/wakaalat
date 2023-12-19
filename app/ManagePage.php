<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManagePage extends Model
{
    protected $fillable=[
        'home_title','home_meta_description','aboutus_title','aboutus_meta_description','doctor_title','doctor_meta_description','service_title','service_meta_description','department_title','department_meta_description','testimonial_title','testimonial_meta_description','faq_title','faq_meta_description','blog_title','blog_meta_description','contactus_title','contactus_meta_description',
    ];
}
