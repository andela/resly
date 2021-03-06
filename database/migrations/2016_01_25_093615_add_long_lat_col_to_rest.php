<?php

use Illuminate\Database\Migrations\Migration;

class AddLongLatColToRest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restaurants', function ($table) {
          $table->double('longitude', 100)->nullable();
          $table->double('latitude', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('restaurants', function ($table) {
          $table->dropColumn(['longitude', 'latitude']);
        });
    }
}
