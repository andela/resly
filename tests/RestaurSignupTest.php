<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RestaurSignupTest extends TestCase
{
    public function testRestaurPageExists()
    {
        $this->visit('/')
             ->click('restaur')
             ->seePageIs('/restaur');
    }

    public function testRegistrationPageExists()
    {
        $this->visit('/restaur')
             ->click('sign up')
             ->seePageIs('/restaur/sign-up');
    }

    public function testRegsitrationDetails()
    {
        $this->visit('/restaur/sign-up')
             ->type('restaur@localhost.com', 'email')
             ->type('restaur', 'username')
             ->type('password', 'password')
             ->click('submit')
             ->seePageIs('/')
             ->see('welcome, restaur');
    }
}
