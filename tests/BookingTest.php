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

    public function testUserCanSelectMultipleTables()
    {
        Session::start();
        $booking = factory('Resly\User')->create([
            'username' => 'orton',
            'role'      => 'diner'
        ]);

        $diner = User::where('username', 'orton')->firstOrFail();
        $this->session(['1orton' => [1]]);
        $response = $this->actingAs($diner)
            ->withSession(['user_id' => $diner->id])
            ->call(
                'POST',
                'multiple/book',
                [
                    'table' => 2,
                ]
            );
        $sessionData = [
            0 => 1,
            1 => 2
        ];
        $this->assertSessionHas("1orton", $sessionData);
        $this->assertEquals(200, $response->status());
        $this->assertEquals("[1,2]", $response->getContent());
    }

    public function testUserCanBookMultipleTables()
    {
        Session::start();
        $this->session(['1orton' => [0=>1, 1=>2]]);
        $booking = factory('Resly\User')->create([
            'username' => 'orton',
            'role'  => 'diner'
        ]);

        $this->seed('DatabaseSeeder');

        $diner = User::where('username', 'orton')->firstOrFail();
        $response = $this->actingAs($diner)
            ->withSession(['user_id' => $diner->id])
            ->call(
                'POST',
                'booking/tables/add',
                [
                    'date' => '31/12/2050 23:59',
                    'duration' => '4'
                ]
            );
        $expectedResponse = '{"message":"Tables added to cart.","status":"success","tables":[1,2]}';

        $this->assertEquals(1, Table::find(1)->is_selected);
        $this->assertEquals(1, Table::find(2)->is_selected);
        $this->assertEquals(200, $response->status());
        $this->assertEquals($expectedResponse, $response->getContent());
    }

    public function testUserCanBookOneTable()
    {
        Session::start();
        $booking = factory('Resly\User')->create([
            'username' => 'orton',
            'role'  => 'diner'
        ]);

        $this->seed('DatabaseSeeder');

        $diner = User::where('username', 'orton')->firstOrFail();
        $response = $this->actingAs($diner)
            ->withSession(['user_id' => $diner->id])
            ->call(
                'POST',
                'booking/table/1/add',
                [
                    'date' => '31/12/2050 23:59',
                    'duration' => '4'
                ]
            );
        $expectedResponse = '{"status":"success","message":"Table added to cart"}';

        $this->assertEquals(1, Table::find(1)->is_selected);
        $this->assertEquals(200, $response->status());
        $this->assertEquals($expectedResponse, $response->getContent());
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
