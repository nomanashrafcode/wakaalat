<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkFaq extends Model
{
    protected $fillable=[
        'question','answer','status',
    ];
}
