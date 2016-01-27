<?php

namespace Resly\Repositories;

use Resly\Restaurant;

class RestaurantRepository extends Repository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Constructor.
     */
    public function __construct(Restaurant $resto)
    {
        $this->model = $resto;
    }
}
