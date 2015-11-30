<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number_of_people');
            $table->time('booking_time');
            $table->date('booking_date');
            $table->integer('diner_id')->unsigned();
            $table->integer('table_id')->unsigned();
            $table->softDeletes();
            $table->nullableTimestamps();

            $table->foreign('diner_id')->references('id')->on('users');
            $table->foreign('table_id')->references('id')->on('tables');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bookings');
    }
}
