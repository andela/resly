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
            $table->integer('restaurateur_id')->unsigned();
            $table->string('name', 70);
            $table->string('location', 200);
            $table->string('description', 200);
            $table->time('opening_time');
            $table->time('closing_time');
            $table->string('telephone', 50);
            $table->string('email', 50);
            $table->string('address', 200);
            $table->nullableTimestamps();

            $table->foreign('restaurateur_id')->references('id')
                ->on('Restaurateur');
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
