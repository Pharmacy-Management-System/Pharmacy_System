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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("pharmacy_id");
            $table->enum('status', ['New', 'Processing', 'WaitingForUserConfirmation','Canceled','Confirmed','Delivered']);
            $table->boolean("is_insured");
            $table->enum('creator_type',['client','doctor','pharmacy']);
            $table->double('price');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('pharmacy_id')->references('id')->on('pharmacies'); //refers to pharmacy that has the order


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
};
