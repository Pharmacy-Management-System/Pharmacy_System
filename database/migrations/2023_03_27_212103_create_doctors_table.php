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
        Schema::create('doctors', function (Blueprint $table) {
            $table->unsignedBigInteger('national_id')->primary();
            $table->string('email')->unique();
            $table->string('name');
            $table->string('password');
            $table->string('avatar');
            $table->unsignedBigInteger('pharmacy_id');
            $table->foreign('pharmacy_id')->references('pharmacy_id')->on('pharmacies');
            $table->boolean('is_banned');
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
        Schema::dropIfExists('doctors');
    }
};
