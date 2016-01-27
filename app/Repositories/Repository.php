<?php

namespace Resly\Repositories;

use Resly\Repositories\Contracts\BaseInterface;

abstract class Repository implements BaseInterface
{
    public function getAll()
    {
        return $this->model->all();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function orderBy($data, $field)
    {
        return $this->model->where($data)->orderBy($field)->get();
    }

    public function sortByDesc($attribute)
    {
        return $this->getAll()->sortByDesc($attribute);
    }

    public function createData($data)
    {
        return $this->model->create($data);
    }

    public function getOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function getFirstBy($key, $value)
    {
        return $this->model->where($key, $value)->first();
    }
}
