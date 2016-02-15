<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TableTest extends TestCase
{
    /**
     * Test the adding of restaurants
     *
     * @return void
     */

    public function _testAddTablesBulkPageIsLoaded()
    {
        $this->visit('/tables/add-bulk')
            ->see("Add the Tables' details");
    }

    public function testDummyTest()
    {
        $this->assertTrue(true);
    }

}
