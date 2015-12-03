<?php

namespace Resly;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function menu_items()
    {
        return $this->belongsToMany('Resly\Menu_item');
    }
}
