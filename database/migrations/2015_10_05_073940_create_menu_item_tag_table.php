<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemTagTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('menu_item_tag', function (Blueprint $table) {
            $table->integer('menu_item_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->nullableTimestamps();

            $table->foreign('menu_item_id')->references('id')->on('menu_items');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('menu_item_tag');
    }
}
