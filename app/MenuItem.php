<?php

namespace Resly;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $table = 'menu_items';
    protected $fillable =
        [
            'name',
            'description',
            'price',
            'cat_id',
            'restaurant_id',
        ];

    public function categories()
    {
        return $this->hasMany('Resly\Category');
    }

    public function tags()
    {
        return $this->belongsToMany(
            'Resly\Tag',
            'Menu_item_tag',
            'menu_item_id',
            'tag_id'
        );
    }
}
