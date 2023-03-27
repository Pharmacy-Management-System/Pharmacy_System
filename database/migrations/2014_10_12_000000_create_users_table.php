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
        Schema::create('users', function (Blueprint $table) {
            $table->unsignedBigInteger('national_id')->primary();
            $table->string('name');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('password');
            $table->date("date_of_birth");
            $table->string('avatar_image');
            $table->string('email')->unique();
            $table->string('phone');
            $table->unsignedBigInteger('area_id');
            $table->foreign('area_id')->references('area_id')->on('areas');
            $table->string('street_name');
            $table->integer('building_no');
            $table->integer('floor_number');
            $table->integer('flat_number');
            $table->boolean('is_main');

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
