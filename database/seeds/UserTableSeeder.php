<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

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
    }
}
