<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsBookedColToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tables', function ($table) {
            $table->boolean('is_on_hold')->default(0);
            $table->boolean('is_booked')->default(0);
            $table->date('booked_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tables', function ($table) {
            $table->dropColumn('is_on_hold');
            $table->dropColumn('is_booked');
            $table->dropColumn('booked_date');
        });
    }
}