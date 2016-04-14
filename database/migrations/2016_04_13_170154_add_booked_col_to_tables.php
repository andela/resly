<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBookedColToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tables', function ($table) {
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
            $table->dropColumn('is_booked');
            $table->dropColumn('booked_date');
        });
    }
}