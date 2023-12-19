<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable=[
        'sort_description','about_description','about_image','mission_description','mission_image','vision_description','vision_image','background_image'
    ];
}
