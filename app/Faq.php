<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable=[
        'category_id','question','answer','status',
    ];

    public function category(){
        return $this->belongsTo(FaqCategory::class,'category_id');
    }
}
