<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceImage extends Model
{
    protected $fillable=[
        'service_id','image'
    ];
}
