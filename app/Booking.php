<?php

namespace Resly;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'number_of_people',
        'booking_date',
        'booking_time',
        'diner_id',
        'table_id',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('Resly\User', 'diner_id');
    }

    public function table()
    {
        return $this->belongsTo('Resly\Table');
    }
}
