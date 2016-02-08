<?php

namespace Resly\Repositories;
use Resly\Table;

class TablesRepository
{
    public function __construct(Table $table)
    {
        $this->table = $table;
    }

    /**
     * Saves a table data to the database
     * @param array $data
     * @return static
     */
    public function store(Array $data)
    {
        return $this->table->create($data);
    }

    public function get($table_id)
    {
        return $this->table->findOrFail($table_id);
    }


    public function getRestaurantTables($restaurant_id)
    {
        return $this->table->where('restaurant_id', $restaurant_id)->get();
    }

    public function update($table_id, $data)
    {
        $table = $this->table->findOrFail($table_id);
        return $table->update($data);
    }

    public function delete($table_id)
    {
        $table = $this->table->findOrFail($table_id);
        return $table->delete();
    }
}