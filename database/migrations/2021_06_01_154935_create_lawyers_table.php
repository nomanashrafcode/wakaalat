<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLawyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('email')->unique();
            $table->string('password');
            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->integer('fee');
            $table->integer('location_id');
            $table->string('phone');
            $table->integer('department_id');
            $table->longText('about');
            $table->longText('educations');
            $table->string('designations');
            $table->longText('address');
            $table->longText('experience');
            $table->longText('qualifications');
            $table->string('image');
            $table->tinyInteger('status');
            $table->tinyInteger('show_homepage');
            $table->string('forget_password_token')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('doctors');
    }
}
