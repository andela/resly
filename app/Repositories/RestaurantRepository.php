<?php

namespace Resly\Repositories;

use Resly\Restaurant;
use Resly\Repositories\Repository;

/**
*
*/
class RestaurantRepository extends Repository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Constructor
     */
    public function __construct(Restaurant $resto)
    {
        $this->model = $resto;
    }
}
