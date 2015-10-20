<?php

namespace Resly;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'Booking';

    protected $fillable = [
            'number_of_people',
            'booking_date',
            'booking_time',
            'diner_id',
            'table_id',
    ];

    public function diner()
    {
        $this->belongsTo('Resly\Diner');
    }

    public function table()
    {
        $this->belongsTo('Resly\Table');
    }
}
