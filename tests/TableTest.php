<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class TableTest extends TestCase
{
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
