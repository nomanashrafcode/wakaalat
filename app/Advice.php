<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advice extends Model
{
    protected $fillable=[
        'appointment_id','advice','test_name','test_description'
    ];
}
