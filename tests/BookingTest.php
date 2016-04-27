<?php

use Resly\User;
use Resly\Table;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookingTest extends TestCase
{
    use DatabaseMigrations;

    public function testQueryReservationAvailability()
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
        $table = Table::all()->first();
        $response = $this->actingAs($diner)
            ->withSession(['user_id' => $diner->id])
            ->call(
                'POST',
                'bookings/create',
                [
                    'table_id' => $table->id,
                    'booking_time' => '16:00:00',
                    'booking_date' => '12/12/2015',
                    'scheduled_date' => '12/12/2016',
                    'user_id' =>  $diner->id,
                    'cost' =>  $table->cost,
                    'type' =>  'table',
                    'duration' => '1',
                    'number_of_people' => 6,
                    '_token' => csrf_token()
                ]
            );
        $this->assertEquals(200, $response->status());
    }

    public function testCanCancelBooking()
    {
        Session::start();

        factory('Resly\Booking')->create([
            'id' => 1,
            'scheduled_date' => '2054-12-12 23:34:34',
            'cost' => 100,
            'is_cancelled' => 0,
        ]);
        $initRefundCount = count(Resly\Refund::all());
        $diner = User::where('role', 'diner')->firstOrFail();
        $response = $this->actingAs($diner)
            ->withSession(['user_id' => $diner->id])
            ->call(
                'POST',
                'booking/cancel',
                [
                    'res' => 1,
                    'offset' => '2015-12-23 23:59:59'
                ]
            );
        $res = Resly\Booking::find(1);
        $refund = Resly\Refund::find(1);
        $expectedResponse = '{"status":"success","res":1,"message":"Booking Cancelled"}';
        $this->assertEquals($expectedResponse, $response->getContent());
        $this->assertEquals(1, $res->is_cancelled);
        $finalRefundCount = count(Resly\Refund::all());
        $this->assertEquals(70, $refund->credits);
        $this->assertEquals(1, $finalRefundCount - $initRefundCount);
        $this->assertEquals(200, $response->status());
    }

    public function testCancelBookingFailsForNoBooking()
    {
        Session::start();

        $this->seed('DatabaseSeeder');

        $diner = User::where('role', 'diner')->firstOrFail();
        $response = $this->actingAs($diner)
            ->withSession(['user_id' => $diner->id])
            ->call(
                'POST',
                'booking/cancel'
            );
        $expectedResponse = '{"status":"failure","message":"Booking not found."}';
        $this->assertEquals($expectedResponse, $response->getContent());
        $this->assertEquals(200, $response->status());

    }

    public function testCancelBookingFailsWrongOwner()
    {
        Session::start();

        factory('Resly\Booking')->create([
            'id' => 1,
            'scheduled_date' => '2054-12-12 23:34:34',
            'is_cancelled' => 0,
            'user_id' => 1,
        ]);
        $anotherUser = factory('Resly\User')->create([
            'id' => 100,
            'role' => 'diner',
            'username' => 'eminado'
        ]);
        $response = $this->actingAs($anotherUser)
            ->withSession(['user_id' => $anotherUser->id])
            ->call(
                'POST',
                'booking/cancel',
                [
                    'res' => 1,
                    'offset' => '2015-12-23 23:59:59'
                ]
            );
        $expectedResponse = '{"status":"failure","message":"You can only cancel your own reservation."}';
        $this->assertEquals($expectedResponse, $response->getContent());
        $this->assertEquals(200, $response->status());

    }

    public function testCancelBookingFailsPassedBooking()
    {
        Session::start();

        factory('Resly\Booking')->create([
            'id' => 1,
            'scheduled_date' => '2004-12-12 23:34:34',
            'is_cancelled' => 0,
            'user_id' => 1,
        ]);
        $user = Resly\User::find(1);
        $response = $this->actingAs($user)
            ->withSession(['user_id' => $user->id])
            ->call(
                'POST',
                'booking/cancel',
                [
                    'res' => 1,
                    'offset' => '2015-12-23 23:59:59'
                ]
            );
        $expectedResponse = '{"status":"failure","message":"This reservation has passed."}';
        $this->assertEquals($expectedResponse, $response->getContent());
        $this->assertEquals(200, $response->status());

    }

    public function testCancelBookingFailsBookingIsTooSoon()
    {
        Session::start();

        factory('Resly\Booking')->create([
            'id' => 1,
            'scheduled_date' => '2015-12-24 00:02:05',
        ]);
        $user = Resly\User::find(1);
        $response = $this->actingAs($user)
            ->call(
                'POST',
                'booking/cancel',
                [
                    'res' => 1,
                    'offset' => '2015-12-23 23:59:59'
                ]
            );
        $expectedResponse = '{"status":"failure","message":"This reservation is too soon to be cancelled."}';
        $this->assertEquals($expectedResponse, $response->getContent());
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
