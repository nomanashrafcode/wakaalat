<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable=[
        'video_category','department_id','service_id','link','status',
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }
    public function service(){
        return $this->belongsTo(Service::class);
    }

}
