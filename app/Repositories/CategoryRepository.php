<?php

namespace Resly\Repositories;

use Resly\Category;
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
    public function __construct(Category $category)
    {
        $this->model = $category;
    }
}
