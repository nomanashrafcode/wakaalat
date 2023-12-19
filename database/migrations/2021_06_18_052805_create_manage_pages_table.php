<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_pages', function (Blueprint $table) {
            $table->id();
            $table->string('home_title')->nullable();
            $table->string('home_meta_description')->nullable();
            $table->string('aboutus_title')->nullable();
            $table->string('aboutus_meta_description')->nullable();
            $table->string('lawyer_title')->nullable();
            $table->string('lawyer_meta_description')->nullable();
            $table->string('service_title')->nullable();
            $table->string('service_meta_description')->nullable();
            $table->string('department_title')->nullable();
            $table->string('department_meta_description')->nullable();
            $table->string('testimonial_title')->nullable();
            $table->string('testimonial_meta_description')->nullable();
            $table->string('faq_title')->nullable();
            $table->string('faq_meta_description')->nullable();
            $table->string('blog_title')->nullable();
            $table->string('blog_meta_description')->nullable();
            $table->string('contactus_title')->nullable();
            $table->string('contactus_meta_description')->nullable();

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
        Schema::dropIfExists('manage_pages');
    }
}
