<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Model::unguard();

        factory('Resly\Booking', 5)->create();

        factory('Resly\Wine', 5)->create();

        Model::reguard();
    }
}
