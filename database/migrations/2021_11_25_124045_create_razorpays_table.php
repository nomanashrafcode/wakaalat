<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRazorpaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('razorpays', function (Blueprint $table) {
            $table->id();
            $table->string('razorpay_key');
            $table->string('secret_key');
            $table->string('name');
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('theme_color')->nullable();
            $table->integer('razorpay_status')->default(1);
            $table->string('currency_rate')->default(1);
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
        Schema::dropIfExists('razorpays');
    }
}
