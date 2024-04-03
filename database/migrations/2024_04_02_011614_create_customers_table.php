<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('phone',11);
            $table->string('email',100);
            $table->boolean('gender')->default(0);
            $table->date('birthdate');
            $table->text('avatar');
            $table->string('username',50);
            $table->string('password',32);
            $table->string('address',100);
            $table->unsignedBigInteger('wards_id');
            $table->unsignedBigInteger('districts_id');
            $table->unsignedBigInteger('cities_id');
            $table->foreign('cities_id')->references('id')->on('cities');
            $table->foreign('districts_id')->references('id')->on('districts');
            $table->foreign('wards_id')->references('id')->on('wards');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
