<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOthersTable extends Migration
{
    public function up()
    {
        Schema::create('others', function (Blueprint $table) {
            $table->id();
            $table->string('internet',100);
            $table->string('layout',100);
            $table->string('type',100);
            $table->string('keycap_profile',100);
            $table->string('bluetooh',100);
            $table->string('led',100);
            $table->string('switch',100);
            $table->text('support');
            $table->string('keycap',50);
            $table->string('dpi',50);
            $table->string('foam',50);
            $table->string('stab',50);
            $table->string('sensor',50);
            $table->string('compatibility',100);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('others');
    }
}
