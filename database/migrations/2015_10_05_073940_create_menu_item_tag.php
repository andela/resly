<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemTag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Menu_item_tag', function (Blueprint $table) {
            $table->integer('menu_item_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->nullableTimestamps();

            $table->foreign('menu_item_id')->references('id')->on('Menu_item');
            $table->foreign('tag_id')->references('id')->on('Tag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Menu_item_tag');
    }
}