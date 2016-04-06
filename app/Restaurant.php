<?php

namespace Resly;

use Illuminate\Database\Eloquent\Model;
use Resly\Rating;
use Auth;

class Restaurant extends Model
{

    protected $fillable = [
        'name',
        'restauranteur_id',
        'description',
        'opening_time',
        'closing_time',
        'location',
        'telephone',
        'email',
        'address',
    ];

    public function tables()
    {
        return $this->hasMany('Resly\Table', 'restaurant_id');
    }

    public function user()
    {
        return $this->belongsTo('Resly\User');
    }

    public function bookings()
    {
        return $this->hasManyThrough(
            'Resly\Booking',
            'Resly\Table',
            'restaurant_id',
            'table_id'
        );
    }

    public function pictures()
    {
        return $this->hasMany('Resly\RestaurantPictures', 'restaurant_id');
    }

    public function getName()
    {
        if ($this->name) {
            return $this->name;
        }
    }

    public function getRestName()
    {
        return $this->getName();
    }

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

    public function ratings()
    {
        return $this->hasMany('Resly\Rating', 'restaurant_id');
    }

    public function averageRating()
    {
        $result =  Rating::where('restaurant_id', '=', $this->id)->avg('rating');
        return $result;
    }

    public function userHasNotRated($booking_id)
    {
        if (Rating::where('user_id', Auth::user()->id)->where('restaurant_id', $this->id)->where('booking_id', $booking_id)->first() == null) {
            return true;
        } else {
            return false;
        }
    }

    public function userRating($booking_id)
    {
        return Rating::where('user_id', Auth::user()->id)
            ->where('restaurant_id', $this->id)->where('booking_id', $booking_id)->first()->rating;
    }
}
