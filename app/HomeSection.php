<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    protected $fillable=[
        'first_header','second_header','description','section_type','show_homepage','section_name','content_quantity'
    ];
}
