<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    protected $fillable=[
        'name','status','slug'
    ];

    public function faqs(){
        return $this->hasMany(Faq::class,'category_id');
    }
}
