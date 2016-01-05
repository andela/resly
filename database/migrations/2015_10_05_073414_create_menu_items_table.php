<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->string('description', 200);
            $table->string('price', 45);
            $table->integer('cat_id')->unsigned();
            $table->integer('restaurant_id')->unsigned();
            $table->nullableTimestamps();

            $table->foreign('cat_id')->references('id')->on('categories');
            $table->foreign('restaurant_id')->references('id')->on('restaurants');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('menu_items');
    }
}
