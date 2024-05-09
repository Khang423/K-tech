<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('order_detail_id');
            $table->string('receive_name',50);
            $table->string('receive_phone',11);
            $table->smallInteger('status')->index();
            $table->double('total_price');
            $table->text('address');
            $table->unsignedBigInteger('ward_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('citys');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('ward_id')->references('id')->on('wards');
            $table->foreign('order_detail_id')->references('id')->on('order_details');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
