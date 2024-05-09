<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWardsTable extends Migration
{
    public function up()
    {
        Schema::create('wards', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->unsignedBigInteger('district_id');
            $table->foreign('district_id')->references('id')->on('districts');
        });
    }

    public function down()
    {
        Schema::dropIfExists('wards');
    }
}
