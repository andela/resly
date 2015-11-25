<?php

namespace Resly;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Wine extends Model
{
    protected $table = 'wine';
    protected $fillable = [
        'name',
        'description',
        'price',
        'year',
        'restaurateur_id',
    ];

    public function restaurant()
    {
        return $this->belongsTo('Resly\Restaurant');
    }

    public function scopePersonalize()
    {
        if (Auth::restaurateur()->check()) {
            return self::where('restaurateur_id', Auth::restaurateur()->get()->id);
        }
    }
}
