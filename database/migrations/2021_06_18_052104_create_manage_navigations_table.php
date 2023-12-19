<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageNavigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_navigations', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('show_homepage')->default(1);
            $table->tinyInteger('show_aboutus')->default(1);
            $table->tinyInteger('show_doctor')->default(1);
            $table->tinyInteger('show_department')->default(1);
            $table->tinyInteger('show_service')->default(1);
            $table->tinyInteger('show_testimonial')->default(1);
            $table->tinyInteger('show_faq')->default(1);
            $table->tinyInteger('show_blog')->default(1);
            $table->tinyInteger('show_contactus')->default(1);
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
        Schema::dropIfExists('manage_navigations');
    }
}
