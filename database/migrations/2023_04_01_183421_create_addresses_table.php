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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string("street_name");
            $table->integer('building_number');
            $table->integer('floor_number');
            $table->integer('flat_number');
            $table->boolean('is_main');
            $table->unsignedBigInteger("area_id");
            $table->unsignedBigInteger("client_id");
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('client_id')->references('id')->on('clients');
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
        Schema::dropIfExists('addresses');
    }
};
