<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScreensTable extends Migration
{

    public function up()
    {
        Schema::create('screens', function (Blueprint $table) {
            $table->id();
            $table->string('graphic',100);
            $table->string('display_size',100);
            $table->string('display_type',50);
            $table->string('display_resolution',50);
            $table->string('front_camera_resolution',100);
            $table->string('main_camera_resolution',100);
            $table->string('video',50);
            $table->string('camera',50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('screens');
    }
}
