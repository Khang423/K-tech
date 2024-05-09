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
            $table->string('phone',11)->nullable();
            $table->string('email',100);
            $table->boolean('gender')->default(0);
            $table->date('birthdate')->nullable();
            $table->text('avatar')->nullable();
            $table->string('password',100);
            $table->string('address',100)->nullable();
            $table->unsignedBigInteger('ward_id')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('citys');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('ward_id')->references('id')->on('wards');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
