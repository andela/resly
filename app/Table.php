<?php

namespace Resly;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $primaryKey = 'table_id';
    protected $table = 'Table';

    public function restaurant()
    {
        return $this->belongsTo('Resly\Restaurant', 'restaurant_id');
    }
}
