<?php

namespace Resly\Repositories;

use Resly\Category;

class CategoryRepository extends Repository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Constructor.
     */
    public function __construct(Category $category)
    {
        $this->model = $category;
    }
}
