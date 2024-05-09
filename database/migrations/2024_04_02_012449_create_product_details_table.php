<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->string('graphic_card',100)->nullable();
            $table->string('cpu',100)->nullable();
            $table->smallInteger('ram')->nullable();
            $table->string('ram_type',50)->nullable();
            $table->string('ram_slot',50)->nullable();
            $table->integer('ssd')->nullable();
            $table->string('touchscreen',100)->nullable();
            $table->string('bg_plate',100)->nullable();
            $table->double('scan_frequency')->nullable()->comment('tần số quét');
            $table->string('screen_size',100)->nullable();
            $table->string('screen_tech',100)->nullable();
            $table->string('screen_resolution',100)->nullable();
            $table->string('keyboard_light',100)->nullable();
            $table->string('webcam',100)->nullable();
            $table->string('operating_system',100)->nullable();
            $table->string('bluetooth',100)->nullable();
            $table->string('wifi',50)->nullable();
            $table->text('audio_tech')->nullable();
            $table->text('security')->nullable();
            $table->text('connectivity')->nullable();
            $table->text('describe')->nullable();
            $table->double('weight')->nullable();
            $table->string('battery',100)->nullable();
            $table->string('cooling_system',50)->nullable();
            $table->string('color',50)->nullable();
            $table->string('material',50)->nullable();
            $table->string('dimension',100)->nullable();
            $table->string('release_date',100)->nullable();
            $table->foreign('product_id')->references('id')->on('products');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('product_details');
    }
}
