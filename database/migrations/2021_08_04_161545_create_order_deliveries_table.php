<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained();
            $table->foreignId('address_id')->constrained();
            $table->foreignId('order_delivery_type_id')->constrained();
            $table->string('carrier', 255);
            $table->string('tracking_id', 255);
            $table->enum('status', ['DELIVERY NOT INITIATED', 'DELIVERY INITIATED', 'DELIVERY SEND', 'DELIVERY IN-PERSON']);
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
        Schema::dropIfExists('order_deliveries');
    }
}
