<?php

namespace Resly;

class Slots
{
    public static function make($opening_time, $closing_time, $bookings)
    {
        $opening = new \Datetime($opening_time);
        $closing = new \Datetime($closing_time);

        $interval = $opening->diff($closing);
        $hours = $interval->h;

        $entries = [];

        $booking = null;

        for ($current_hour=0; $current_hour < $hours; $current_hour++) {
            $start = clone $opening;
            $start->add(new DateInterval("PT{$current_hour}H"));

            $finish = clone $opening;
            $next_hour = $current_hour + 1;
            $finish->add(new DateInterval("PT{$next_hour}H"));

            $booking = null;

            foreach ($bookings as $booking) {
                $booking_time = new Datetime($booking->booking_time);

                if ($booking_time->diff($start)->h > 0) {
                    $booking = $booking;
                    break;
                }
            }

            $free = $booking == null;
            $entries[] = new SlotEntry($start, $finish, $free);
        }

        return $entries;
    }
}