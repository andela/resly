<?php

use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function ($table) {
            $table->increments('id');
            $table->integer('rating');
            $table->integer('user_id')->unsigned();
            $table->integer('restaurant_id')->unsigned();
            $table->integer('booking_id')->unsigned();
            $table->text('comment');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('booking_id')->references('id')->on('bookings');
            $table->foreign('restaurant_id')->references('id')->on('restaurants');
            $table->index('user_id');
            $table->index('restaurant_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ratings');
    }
}
