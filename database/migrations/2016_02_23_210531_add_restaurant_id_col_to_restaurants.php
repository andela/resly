<?php

use Illuminate\Database\Migrations\Migration;

class AddRestaurantIdColToRestaurants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restaurant_pictures', function ($table) {
            $table->integer('restaurant_id')->unsigned()->default(-1);
            $table->foreign('restaurant_id')->references('id')->on('restaurants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('restaurant_pictures', function ($table) {
            $table->dropColumn(['restaurant_id']);
        });
    }
}
