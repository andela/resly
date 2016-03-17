<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProfileUpdateTest extends TestCase
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

    public function testSeeEditProfile()
    {
        $user = factory('Resly\User')->create();
        $this->actingAs($user)
             ->visit('/user/profile/edit')
             ->see('Update Account Details');
    }

    public function testCanUpdateProfile()
    {
        $user = factory('Resly\User')->create();
        $this->actingAs($user)
             ->visit('/user/profile/edit')
             ->type('newFirstName', 'fname')
             ->press('Update');

        $this->seeInDatabase('users', ['fname' => 'newFirstName']);
    }
}
