<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DinerLoginTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A link to the login page must be present
     *
     * On the diner page there should be link
     * to a page specifically for the login
     * of diners.
     *
     * @return void
     **/
    public function testLoginPageExists()
    {
        $this->visit('/diner')
             ->click('Login')
             ->see('<h3>Login</h3>');
    }

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
        $this->visit('/diner')
             ->click('Login')
             ->type('diner@localhost.com', 'email')
             ->type('password', 'password')
             ->press('Sign in')
             ->seePageIs('/diner');

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
        $this->visit('/diner')
             ->click('Login')
             ->type('diner@localhost.com', 'email')
             ->type('wrong password', 'password')
             ->press('Sign in')
             ->seePageIs('/diner');
    }
}
