<?php

namespace Resly;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $table = 'Table';

    public function restaurants()
    {
        $this->belongsTo('Resly\Restaurant', 'restaurant_id');
    }
}
