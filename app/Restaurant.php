<?php

namespace Resly;

use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;
use Auth;
use Resly\Rating;

class Restaurant extends Model
{
    use Rateable;


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

        return;
    }

    public function getRestName()
    {
        return $this->getName();
    }


    public function userHasNotRated()
    {
        if (Rating::where('user_id', Auth::user()->id)
            ->where('rateable_id', $this->id)->first() == null) {
            return true;
        }
        else {
            return false;
        }
    }
}
