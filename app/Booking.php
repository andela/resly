<?php

namespace Resly;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    protected $table = 'Booking';

    protected $fillable = [
            'number_of_people',
            'booking_date',
            'booking_time',
            'diner_id',
            'table_id',
    ];

    protected $dates = ['deleted_at'];

    public function diner()
    {
        return $this->belongsTo('Resly\Diner');
    }

    public function table()
    {
        return $this->belongsTo('Resly\Table');
    }
}
