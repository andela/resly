<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Restaurant', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->string('location', 200);
            $table->string('description', 200);
            $table->time('opening_time');
            $table->time('closing_time');
            $table->string('telephone', 20);
            $table->string('email', 20);
            $table->string('address', 50);
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
        Schema::drop('Restaurant');
    }
}
