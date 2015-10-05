<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Table', function (Blueprint $table) {
            $table->increments('table_id');
            $table->integer('restaurant_id')->unsigned();
            $table->integer('seats_number');
            $table->string('name', 45);
            $table->timestamps();

            $table->foreign('restaurant_id')->references('id')
                ->on('Restaurant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Table');
    }
}
