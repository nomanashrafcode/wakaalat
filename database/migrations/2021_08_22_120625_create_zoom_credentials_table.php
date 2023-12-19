<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_credentials', function (Blueprint $table) {
            $table->id();
            $table->integer('lawyer_id')->default(0);
            $table->integer('admin_id')->default(0);
            $table->text('zoom_api_key');
            $table->text('zoom_api_secret');
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
        Schema::dropIfExists('zoom_credentials');
    }
}
