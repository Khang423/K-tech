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
            $table->unsignedBigInteger('specifications_id');
            $table->unsignedBigInteger('image_products_id');
            $table->unsignedBigInteger('suppliers_id');
            $table->unsignedBigInteger('brands_id');
            $table->unsignedBigInteger('product_categories_id');
            $table->unsignedBigInteger('screens_id');
            $table->unsignedBigInteger('others_id');
            $table->string('name',50);
            $table->text('description');
            $table->double('price');
            $table->double('stock_quantity');
            $table->foreign('product_categories_id')->references('id')->on('product_categories');
            $table->foreign('brands_id')->references('id')->on('brands');
            $table->foreign('suppliers_id')->references('id')->on('suppliers');
            $table->foreign('image_products_id')->references('id')->on('image_products');
            $table->foreign('specifications_id')->references('id')->on('specifications');
            $table->foreign('others_id')->references('id')->on('others');
            $table->foreign('screens_id')->references('id')->on('screens');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
