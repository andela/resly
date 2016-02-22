<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('username')->unique();
            $table->string('email');
            $table->string('password')->nullable();
            $table->string('avatar_url')->nullable();
            $table->string('role')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('provider_name')->nullable();
            $table->string('stripe_id')->nullable();
            $table->string('card_brand')->nullable();
            $table->string('card_last_four')->nullable();
            $table->rememberToken()->nullable();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
