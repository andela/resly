<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantPicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename');
            $table->string('caption')->nullable();
            $table->integer('restauranteur_id')->unsigned();
           // $table->integer('restaurant_id')->unsigned();
            //$table->foreign('restaurant_id')->references('id')->on('restaurant');
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
        Schema::drop('restaurant_pictures');
    }
}
