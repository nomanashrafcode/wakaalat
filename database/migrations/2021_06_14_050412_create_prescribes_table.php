<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescribes', function (Blueprint $table) {
            $table->id();
            $table->integer('appointment_id');
            $table->string('medicine_type');
            $table->string('medicine_name');
            $table->string('dosage');
            $table->string('number_of_day');
            $table->text('comment')->nullable();
            $table->string('time')->nullable();
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
        Schema::dropIfExists('prescribes');
    }
}
