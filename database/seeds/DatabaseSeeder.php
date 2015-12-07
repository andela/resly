<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        factory('Resly\Booking', 5)->create();

        factory(Resly\User::class, 3)->create();
        factory(Resly\User::class, 3)->create(
            ['role' => 'restaurateur']
        );

        factory(Resly\User::class)->create([
            'role' => 'diner',
            'email' => 'diner@localhost.com',
            'password' => bcrypt('password'),
        ]);

        factory(Resly\User::class)->create([
            'role' => 'restaurateur',
            'email' => 'restaurateur@localhost.com',
            'password' => bcrypt('password'),
        ]);


        Model::reguard();
    }
}
