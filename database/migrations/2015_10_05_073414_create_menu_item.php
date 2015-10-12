<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Menu_item', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->string('description', 200);
            $table->string('price', 45);
            $table->integer('cat_id')->unsigned();
            $table->integer('restaurant_id')->unsigned();
            $table->nullableTimestamps();

            $table->foreign('cat_id')->references('id')->on('Category');
            $table->foreign('restaurant_id')->references('id')->on('Restaurant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        SchemA::drop('Menu_item');
    }
}
