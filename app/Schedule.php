<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable=[
        'day_id','lawyer_id','start_time','end_time','quantity','status',
    ];


    public function day(){
        return $this->belongsTo(Day::class);
    }

    public function lawyer(){
        return $this->belongsTo(Lawyer::class);
    }

}
