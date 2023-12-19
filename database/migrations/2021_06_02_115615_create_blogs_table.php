<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->integer('blog_category_id');
            $table->string('title');
            $table->string('slug');
            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('sort_description');
            $table->longText('description');
            $table->string('thumbnail_image')->nullable();
            $table->string('feature_image')->nullable();
            $table->tinyInteger('status');
            $table->tinyInteger('show_feature_blog');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
