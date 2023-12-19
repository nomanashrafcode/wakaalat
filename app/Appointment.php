<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable=[
        'lawyer_id','user_id','day_id','schedule_id','date','appointment_fee','payment_status','payment_transaction_id','payment_method','payment_description','already_treated','status','order_id'
    ];

    public function day(){
        return $this->belongsTo(Day::class);
    }
    public function lawyer(){
        return $this->belongsTo(Lawyer::class);
    }
    public function schedule(){
        return $this->belongsTo(Schedule::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function prescription(){
        return $this->hasOne(Prescription::class);
    }

    public function advice(){
        return $this->hasOne(Advice::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }


}
