<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigations', function (Blueprint $table) {
            $table->id();
            $table->string('home')->default('home');
            $table->tinyInteger('show_home')->default(1);
            $table->string('about_us')->default('about_us');
            $table->tinyInteger('show_aboutus')->default(1);
            $table->string('pages')->default('pages');
            $table->tinyInteger('show_pages')->default(1);
            $table->string('department')->default('department');
            $table->tinyInteger('show_department')->default(1);
            $table->string('lawyer')->default('lawyer');
            $table->tinyInteger('show_lawyer')->default(1);
            $table->string('service')->default('service');
            $table->tinyInteger('show_service')->default(1);
            $table->string('testimonial')->default('testimonial');
            $table->tinyInteger('show_testimonial')->default(1);
            $table->string('faq')->default('faq');
            $table->tinyInteger('show_faq')->default(1);
            $table->string('contact_us')->default('contact_us');
            $table->tinyInteger('show_contactus')->default(1);
            $table->string('appointment')->default('appointment');
            $table->tinyInteger('show_appointment')->default(1);
            $table->string('dashboard')->default('dashboard');
            $table->tinyInteger('show_dashboard')->default(1);
            $table->string('payment')->default('payment');
            $table->tinyInteger('show_payment')->default(1);
            $table->string('blog')->default('blog');
            $table->tinyInteger('show_blog')->default(1);
            $table->string('login')->default('login');
            $table->tinyInteger('show_login')->default(1);
            $table->string('register')->default('register');
            $table->tinyInteger('show_register')->default(1);
            $table->string('terms_and_condition')->default('terms_and_condition');
            $table->tinyInteger('show_terms_and_condition')->default(1);
            $table->string('privacy_policy')->default('privacy_policy');
            $table->string('forget_password')->default('forget_password');
            $table->string('reset_password')->default('reset_password');
            $table->tinyInteger('show_privacy_policy')->default(1);
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
        Schema::dropIfExists('navigations');
    }
}
