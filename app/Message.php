<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable=[
        'lawyer_id','user_id','message','lawyer_view','patient_view','send_lawyer','send_user'
    ];
}
