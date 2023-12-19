<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('order_id');
            $table->double('total_payment');
            $table->integer('appointment_qty');
            $table->string('payment_method');
            $table->tinyInteger('payment_status')->default(0);
            $table->string('payment_transaction_id')->nullable();
            $table->text('payment_description')->nullable();
            $table->string('last4')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('show_notification')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
