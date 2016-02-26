<?php

namespace Resly;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = ['restaurant_id', 'label', 'seats_number', 'cost'];

    public function restaurant()
    {
        return $this->belongsTo('Resly\Restaurant');
    }
}
