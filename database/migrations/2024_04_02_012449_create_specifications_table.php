<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecificationsTable extends Migration
{
    public function up()
    {
        Schema::create('specifications', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('model',100);
            $table->string('operating_system',100);
            $table->string('processor',100);
            $table->string('ram',50);
            $table->string('rom',50);
            $table->string('storage',50);
            $table->string('wifi',50);
            $table->string('connectivity',100);
            $table->string('battery',100);
            $table->string('cooling_system',50);
            $table->string('color',50);
            $table->string('material',50);
            $table->string('dimension',100);
            $table->string('included_accessories',100);
            $table->string('charging_technolory',100);
            $table->string('release_date',100);
            $table->string('warranty_duration',100);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('specifications');
    }
}
