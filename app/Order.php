<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
        'user_id','order_id','total_payment','appointment_qty','payment_method','payment_status','status','payment_transaction_id','payment_description','show_notification','last4'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }
}
