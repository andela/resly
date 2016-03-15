<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SearchTest extends TestCase
{
    use DatabaseMigrations;
    
    /**
     * Anyone can search for restaurants by name
     *
     * Enter the restaurants name and
     * click the Go button, to display the results page.
     *
     * @return void
     */
    public function testSearchCanBeDone()
    {
        $this->visit('/')
             ->type('name', 'query')
             ->press('Go!')
             ->seePageIs('/search?query=name')
             ->see('Results');
    }
}
