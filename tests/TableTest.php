<?php

class TableTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */

    public function testAddTablePageIsSeen()
    {
        $this->visit('/table/add')
            ->see('Add tables here');
    }

    /** Add tests here */
}
