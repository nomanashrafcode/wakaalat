<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValidationText extends Model
{
    protected $fillable=[
        'name','email','unique_email','password','confirm_password','phone','subject','message','comment','transaction_info','age','occupation','gender','address','country','city','valid_email','minimum_password'
    ];
}
