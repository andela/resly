<?php

namespace Resly;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $table = 'Menu_item';
    protected $fillable =
        [
            'name',
            'description',
            'price',
            'cat_id',
            'restaurant_id',
        ];

    public function category()
    {
        return $this->hasMany('Resly\Category');
    }
}
