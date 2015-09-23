<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DinerSignupTest extends TestCase
{

    /**
     * A link to the diner page must be present
     *
     * On the home page there should be a link
     * to a page specifically for diners
     *
     * @return void
     **/
    public function testDinerPageExists()
    {
        $this->visit('/')
             ->click('diner')
             ->seePageIs('/diner');
    }

    /**
     * A link to the registration page should
     * exist
     *
     * on the diner specific page there should
     * be a link to a registration page.
     *
     * @return void
     **/
    public function testRegistrationPageExists()
    {
        $this->visit('/diner')
             ->click('sign up')
             ->seePageIs('/diner/sign-up');
    }

    /**
     * The registration form accepts user details
     *
     * A user can signup by providing username
     * password and email address, then click submit.
     *
     * @return void
     **/
    public function testRegsitrationDetails()
    {
        $this->visit('/diner/sign-up')
             ->type('diner@localhost.com', 'email')
             ->type('diner', 'username')
             ->type('password', 'password')
             ->click('submit')
             ->seePageIs('/')
             ->see('welcome, diner');
    }
}
