<?php

namespace Resly\Repositories;

use Resly\Booking;

class BookingRepository extends Repository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Constructor.
     */
    public function __construct(Booking $booking)
    {
        $this->model = $booking;
    }
}
