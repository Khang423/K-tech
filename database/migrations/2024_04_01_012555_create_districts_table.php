<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictsTable extends Migration
{
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('citys');
        });
    }

    public function down()
    {
        Schema::dropIfExists('districts');
    }
}
