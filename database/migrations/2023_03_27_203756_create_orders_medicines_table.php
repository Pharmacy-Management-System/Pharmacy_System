<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_medicines', function (Blueprint $table) {

            $table->unsignedInteger('order_id');
            $table->unsignedInteger('medicine_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('medicine_id')->references('id')->on('medicines');
            $table->integer('quantity');
            $table->primary(['order_id', 'medicine_id']);
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
        Schema::dropIfExists('orders_mediciens');
    }
};
