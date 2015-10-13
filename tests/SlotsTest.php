<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Resly\Slots;

class SlotsTest extends TestCase
{
    public function testCanCreateEntries()
    {
        $booking1 = factory('Resly\Booking')->make([
            'booking_time' => "9:30"
        ]);

        $booking2 = factory('Resly\Booking')->make([
            'booking_time' => "13:30"
        ]);

        $openning_time = "8:00";
        $closing_time = "17:00";

        $entries = Slots::make($openning_time, $closing_time, [
            $booking1, $booking2
        ]);

        $this->assertEquals(count($entries), 9);

        $this->assertEquals($entries[0]->startingTime(), new \DateTime($openning_time));
        $this->assertEquals($entries[8]->startingTime(), new \DateTime("16:00"));

        // 8:00-9:00
        $this->assertEquals($entries[0]->isFree(), true);

        // 9:00-10:00 --booking 1
        $this->assertEquals($entries[1]->isFree(), false);

        // 10:00-11:00 -- booking 1
        $this->assertEquals($entries[2]->isFree(), false);

        // 11:00-12:00
        $this->assertEquals($entries[3]->isFree(), true);

        // 12:00-13:00
        $this->assertEquals($entries[4]->isFree(), true);

        // 13:00-14:00 -- booking 2
        $this->assertEquals($entries[5]->isFree(), false);

        // 14:00-15:00 -- booking 2
        $this->assertEquals($entries[6]->isFree(), false);

        // 15:00-16:00
        $this->assertEquals($entries[7]->isFree(), true);

        // 16:00-17:00
        $this->assertEquals($entries[8]->isFree(), true);
    }
}
