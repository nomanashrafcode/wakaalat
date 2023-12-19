<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable=[
        'blog_category_id','title','slug','description','thumbnail_image','feature_image','status','show_feature_blog','sort_description','seo_title','seo_description'
    ];

    public function category(){
        return $this->belongsTo(BlogCategory::class,'blog_category_id');
    }


    public function comments(){
        return $this->hasMany(BlogComment::class);
    }
}
