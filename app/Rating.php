<?php

namespace Resly;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['rating', 'user_id', 'restaurant_id', 'booking_id', 'comment'];
}
