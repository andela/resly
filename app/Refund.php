<?php

namespace Resly;

use Illuminate\Database\Eloquent\Model;
use Resly\User;
use Resly\Booking;

class Refund extends Model
{
    protected $fillable = [
        'credits',
        'user_id',
        'booking_id',
    ];

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function booking()
    {
        return $this->hasOne('Resly\Booking');
    }
}
