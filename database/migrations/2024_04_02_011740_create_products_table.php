<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('category_id');
            $table->string('name',50);
            $table->double('price')->nullable();
            $table->text('outsite_image')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('member_id')->references('id')->on('members');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
