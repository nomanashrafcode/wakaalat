<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable=[
        'lawyer_id','date','status',
    ];
}
