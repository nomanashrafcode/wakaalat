<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescribe extends Model
{
    protected $fillable=[
        'appointment_id','medicine_type','medicine_name','dosage','number_of_day','comment','time'
    ];
}
