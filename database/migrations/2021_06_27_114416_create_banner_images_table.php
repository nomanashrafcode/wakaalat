<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_images', function (Blueprint $table) {
            $table->id();
            $table->string('admin_login')->nullable();
            $table->string('lawyer_login')->nullable();
            $table->string('about_us')->nullable();
            $table->string('subscribe_us')->nullable();
            $table->string('lawyer')->nullable();
            $table->string('service')->nullable();
            $table->string('department')->nullable();
            $table->string('testimonial')->nullable();
            $table->string('faq')->nullable();
            $table->string('contact')->nullable();
            $table->string('profile')->nullable();
            $table->string('login')->nullable();
            $table->string('payment')->nullable();
            $table->string('overview')->nullable();
            $table->string('about_us_bg')->nullable();
            $table->string('custom_page')->nullable();
            $table->string('blog')->nullable();
            $table->string('terms_and_condition')->nullable();
            $table->string('privacy_and_policy')->nullable();
            $table->string('default_profile')->default('default_profile');
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
        Schema::dropIfExists('banner_images');
    }
}
