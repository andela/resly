<?php

class RestaurantTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */

    public function testAddRestaurantPageIsSeen()
    {
        $this->visit('/restaurant/add')
            ->see('Add restaurant here');
    }

    // public function testRestaurantIsAdded()
    // {
    //     $this->visit('/restaurant/add')
    //         ->type('restaurant_name', 'My First Restaurant')
    //         ->type('description', 'We are awesome')
    //         ->type('opening_time', '08:00:00')
    //         ->type('closing_time', '17:00:00')
    //         ->type('location', 'Nairobi West')
    //         ->type('telephone', '+2517238293')
    //         ->type('email', 'first.rest@resly.com')
    //         ->type('address', '50504, Nairobi')
    //         ->press('Next')
    //         ->see('/table/add');
    // }

    /** Add tests for restaurant controller here */
}
