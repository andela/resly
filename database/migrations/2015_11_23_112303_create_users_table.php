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
            $table->string('fname');
            $table->string('lname');
            $table->string('username')->unique();
            $table->string('email');
            $table->string('password');
            $table->string('gravatarURL')->nullable();
            $table->string('avatarURL')->nullable();
            $table->string('role');
            $table->string('provider_id')->nullable();
            $table->string('provider_name')->nullable();
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
