<?php

namespace Resly;

use Illuminate\Database\Eloquent\Model;

class RestaurantPictures extends Model
{
    protected $fillable = [
        'filename',
        'caption',
        'restauranteur_id',
        'restaurant_id',
    ];
}
