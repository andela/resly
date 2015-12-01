<?php

namespace Resly;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public function restaurant()
    {
        return $this->belongsTo('Resly\Restaurant');
    }
}
