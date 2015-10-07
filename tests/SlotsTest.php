<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Resly\Slots;

class SlotsTest extends TestCase
{
    public function testCanCreateEntries()
    {
        $booking1 = factory('Resly\Booking')->make();
        $booking2 = factory('Resly\Booking')->make();

        $openning_time = "Friday 13:00 3 September";
        $closing_time = "Friday 13:00 3 September";
        $entries = Slots::make($openning_time, $closing_time, [
            $booking1, $booking2
        ]);

        $this->assertEquals(count($entries), 1);
    }
}
