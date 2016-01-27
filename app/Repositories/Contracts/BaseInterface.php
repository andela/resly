<?php

namespace Resly\Repositories\Contracts;

interface BaseInterface
{
    public function getAll();
    public function findById($id);
    public function getOrFail($id);
    public function createData($data);
    public function orderBy($data, $field);
    public function sortByDesc($attribute);
    public function getFirstBy($key, $value);
}
