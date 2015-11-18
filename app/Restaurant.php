<?php

namespace Resly;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'Restaurant';

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

    public function wine()
    {
        return $this->hasMany('Resly\Wine');
    }

    public function tables()
    {
        return $this->hasMany('Resly\Table', 'table_id');
    }

    public function restaurateur()
    {
        return $this->belongsTo('Resly\Restaurateur');
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
}
