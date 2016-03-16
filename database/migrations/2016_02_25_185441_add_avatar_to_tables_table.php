<?php

use Illuminate\Database\Migrations\Migration;

class AddAvatarToTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tables', function ($table) {
            $table->string('avatar')->nullable();
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
            $table->dropColumn(['avatar']);
        });
    }
}
