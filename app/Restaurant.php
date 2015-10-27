<?php

namespace Resly;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $primary_key = 'id';
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

    public function tables()
    {
        $this->hasMany('Resly/Table');
    }

    public function restaurateur()
    {
        $this->belongsTo('Resly\Restaurateur');
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
