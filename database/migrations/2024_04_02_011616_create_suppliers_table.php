<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('phone',11);
            $table->string('email',100);
            $table->string('address',100);
            $table->unsignedBigInteger('ward_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('citys');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('ward_id')->references('id')->on('wards');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}
