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
            $table->unsignedBigInteger('customers_id');
            $table->unsignedBigInteger('members_id');
            $table->unsignedBigInteger('order_details_id');
            $table->string('receive_name',50);
            $table->string('receive_phone',11);
            $table->smallInteger('status')->index();
            $table->double('total_price');
            $table->text('address');
            $table->unsignedBigInteger('wards_id');
            $table->unsignedBigInteger('districts_id');
            $table->unsignedBigInteger('cities_id');
            $table->foreign('cities_id')->references('id')->on('cities');
            $table->foreign('districts_id')->references('id')->on('districts');
            $table->foreign('wards_id')->references('id')->on('wards');
            $table->foreign('order_details_id')->references('id')->on('order_details');
            $table->foreign('customers_id')->references('id')->on('customers');
            $table->foreign('members_id')->references('id')->on('members');
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
