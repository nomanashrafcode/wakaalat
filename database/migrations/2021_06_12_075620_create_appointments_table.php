<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('lawyer_id');
            $table->integer('order_id');
            $table->integer('user_id');
            $table->integer('day_id');
            $table->integer('schedule_id');
            $table->date('date');
            $table->double('appointment_fee');
            $table->tinyInteger('payment_status')->default(0);
            $table->string('payment_transaction_id')->nullable();
            $table->string('payment_method')->nullable();
            $table->text('payment_description')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->string('pulse_rate')->nullable();
            $table->string('temperature')->nullable();
            $table->text('problem_description')->nullable();
            $table->text('habits')->nullable();
            $table->tinyInteger('already_treated')->default(0);
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('appointments');
    }
}
