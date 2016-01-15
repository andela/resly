<?php

use Resly\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookingTest extends TestCase
{
    //use DatabaseMigrations;

    public function testQuerryReservationAvailability()
    {
        Session::start();

        $this->seed('DatabaseSeeder');

        $diner = User::where('role', 'diner')->firstOrFail();

        $response = $this->actingAs($diner)->call('POST', 'bookings/begin', [
            'restaurant_id' => 1,
            'number_of_people' => 5,
            'booking_date' => '12/12/2015',
            '_token' => csrf_token()
        ]);

        $this->assertEquals(200, $response->status());
    }

    public function testCanCreateBooking()
    {
        Session::start();

        $this->seed('DatabaseSeeder');

        $diner = User::where('role', 'diner')->firstOrFail();

        $response = $this->actingAs($diner)
            ->withSession(['user_id' => $diner->id])
            ->call(
                'POST',
                'bookings/create',
                [
                    'table_id' => 1,
                    'booking_time' => '16:00:00',
                    'booking_date' => '12/12/2015',
                    'number_of_people' => 6,
                    '_token' => csrf_token()
                ]
            );

        $this->assertEquals(200, $response->status());
    }

    public function testDinerCanViewReservations()
    {
        // create a reservation first
        $booking = factory('Resly\Booking')->create();

        $user = $booking->user;

        $this->actingAs($user)
            ->visit('bookings')
            ->see($booking->booking_date);
    }

    public function testRestaurantReservationsCanBeViewed()
    {
        $this->seed('DatabaseSeeder');

        $booking = factory('Resly\Booking')->create();

        $restaurateur = $booking->table->restaurant->user;

        $this->actingAs($restaurateur)
            ->visit('bookings')
            ->see($booking->booking_date);
    }

    public function testDinerCanCancelReservation()
    {
        // create a reservation first
        $booking = factory('Resly\Booking')->create();

        $user = $booking->user;

        $this->actingAs($user)
            ->visit('bookings')
            ->press('Cancel')
            ->see('Booking cancelled successfully.');
    }
}
