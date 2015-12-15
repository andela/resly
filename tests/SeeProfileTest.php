<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SeeProfileTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testSeeUserProfile()
    {
        $user = factory('Resly\User')->create();
        $this->actingAs($user)
             ->visit('/dashboard')
             ->see('Your Profile');
    }
}
