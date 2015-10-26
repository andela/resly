<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookingTest extends TestCase
{
    use DatabaseMigrations;

    public function testCanSeeAllBookings()
    {
        //..
    }

    public function testCanCreateBooking()
    {
        Session::start();

         $this->seed('DatabaseSeeder');

         $diner = factory('Resly\Diner')->create();

        $response = $this->actingAs($diner)->call('POST', 'bookings/begin', [
            'restaurant_id' => 1,
            'number_of_people' => 5,
            'booking_date' => '12/12/2015',
            '_token' => csrf_token()
        ]);

        $this->assertEquals(200, $response->status());
    }

    public function testCanViewSingleBooking()
    {
        //..
    }

    public function testCanUpdateBooking()
    {
        //..
    }

    public function testCanDeleteBooking()
    {
        //..
    }
}
