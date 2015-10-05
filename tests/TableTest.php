<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TableTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * Test the adding of restaurants
     *
     * @return void
     */

    public function testAddTablesBulkPageIsLoaded()
    {
        $this->visit('/tables/add-bulk')
            ->see("Add the Tables' details");
    }

}
