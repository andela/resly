<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SearchTest extends TestCase
{
    /**
     * The diner can search for restaurants by name
     *
     * Go to the diner page, enter the restaurants name and
     * click the search button, to display the results page.
     *
     * @return void
     */
    public function testDinerSearchCanBeDone()
    {
        $this->visit('/diner')
        	 ->type('restaurantName', 'query')
        	 ->press('Search')
        	 ->seePageIs('/diner/search')
        	 ->see('Results');
    }
}
