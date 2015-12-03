<?php

namespace Resly;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name'];

    public function menuItems()
    {
        $this->belongsTo('Resly\MenuItem');
    }
}
