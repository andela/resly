<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RestaurLoginTest extends TestCase
{
    /**
     * A link to the diner page must be present
     *
     * On the home page there should be a link
     * to a page specifically for diners
     *
     * @return void
     **/
    public function testRestaurPageExists()
    {
        $this->visit('/')
             ->click('restauranter')
             ->seePageIs('/rest');
    }

    /**
     * A link to the login page must be present
     *
     * On the restauranteur page there should be link
     * to a page specifically for the login
     * of diners.
     *
     * @return void
     **/
    public function testLoginPageExists()
    {
        $this->visit('/rest')
             ->click('login')
             ->seePageIs('/rest/login');
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
        $this->visit('/rest/login')
             ->type('restauranteur@localhost.com', 'email')
             ->type('password', 'password')
             ->click('log in')
             ->seePageIs('/')
             ->see('welcome, restauranteur');
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
        $this->visit('/rest/login')
             ->type('restauranteur@localhost.com', 'email')
             ->type('wrong password', 'password')
             ->click('log in')
             ->seePageIs('/login');
    }
}

