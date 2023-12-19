<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceFaq extends Model
{
    protected $fillable=[
        'service_id','question','answer','status',
    ];

    public function service(){
        return $this->belongsTo(Service::class);
    }
}
