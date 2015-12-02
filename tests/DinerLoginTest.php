<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Resly\Diner;
use Hash;

class DinerLoginTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * The login form should authenticate valid
     * credentials
     *
     * The login form should be able to verify
     * correct login details and redirect users
     * to the landing page.
     *
     * The landing page should be able to recognise
     * the user if they have successfuly
     * authenticated.
     *
     * @return void
     **/
    public function testLoginAcceptsCredentials()
    {
        $this->seed('DatabaseSeeder');

        $this->visit('/')
             ->click('Login')
             ->type('diner@localhost.com', 'email')
             ->type('password', 'password')
             ->press('Sign in')
             ->seePageIs('/');

    }

    /**
     * The login form should reject invalid
     * credentials
     *
     * The login form should be able to recognise
     * invalid credentials and display the login
     * form again, to give the user another chance
     * to provide the correct details.
     *
     * @return void
     **/
    public function testDinerRejectsCredentials()
    {
        $this->seed('DatabaseSeeder');

        $diner = new Diner();

        $diner->username = 'dinerone';
        $diner->email = 'diner@localhost.com';
        $diner->password = Hash::make('password');
        $diner->save();

        $this->visit('/')
             ->click('Login')
             ->type('diner@localhost.com', 'email')
             ->type('wrong password', 'password')
             ->press('Sign in')
             ->seePageIs('/auth/login');
    }
}
