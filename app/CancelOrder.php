<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CancelOrder extends Model
{
    protected $fillable=[
        'user_id','order_id','date','appointment_fee','payment_method','transaction_id','return_status','appointment_qty'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
}
