<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageProductsTable extends Migration
{
    public function up()
    {
        Schema::create('image_products', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->text('image');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('image_products');
    }
}
