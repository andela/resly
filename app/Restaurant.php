<?php

namespace Resly;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $primary_key = 'id';
    protected $table = 'Restaurant';

    protected $fillable =
        [
            'name',
            'description',
            'opening_time',
            'closing_time',
            'location',
            'telephone',
            'email',
            'address',
        ];

    public function tables()
    {
        $this->hasMany('Resly/Table');
    }
}