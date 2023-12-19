<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartmentImage extends Model
{
    protected $fillable=[
        'department_id','image','small_image',
        'large_image'
    ];
}
