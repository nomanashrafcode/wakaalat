<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable=[
        'name','slug','description','show_homepage','status','thumbnail_image','seo_title',
        'seo_description'
    ];

    public function images(){
        return $this->hasMany(DepartmentImage::class);
    }

    public function faqs(){
        return $this->hasMany(DepartmentFaq::class);
    }

    public function videos(){
        return $this->hasMany(Video::class);
    }
}
