<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDinerProfilePhotoTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('diner_photo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('diner_id')->unsigned();
            $table->foreign('diner_id')->references('id')->on('Diner')->onDelete('cascade');
            $table->string('path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('diner_photo');
    }
}
