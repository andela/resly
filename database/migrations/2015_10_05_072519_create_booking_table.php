<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Booking', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number_of_people');
            $table->dateTime('booking_time');
            $table->integer('diner_id')->unsigned();
            $table->integer('table_id')->unsigned();
            $table->timestamps();

            $table->foreign('diner_id')->references('id')->on('Diner');
            $table->foreign('table_id')->references('table_id')->on('Table');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Booking');
    }
}
