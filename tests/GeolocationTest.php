<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Resly\Restaurant;

class GeolocationTest extends TestCase
{
	use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHomePage()
    {
        $this->visit('/')
        ->see('Restaurants Closeby');
    }

    public function testLongitudeAndLatitudeColInRestaurantTable()
    {
    	 DB::transaction(function () {
            // Seed some data and delete it afterwards
            $restaurant = factory('Resly\Restaurant')->make();

            DB::table('restaurants')->insert($restaurant->getAttributes());

            DB::table('restaurants')->where('email', $restaurant->email)
                ->update(['latitude' => '6.5048824', 'longitude' => '3.377682400000026']);

    		$this->seeInDatabase('restaurants', 
    			['latitude' => '6.5048824', 'longitude' => '3.377682400000026']);

    		DB::table('restaurants')->where('email', $restaurant->email)->delete();
        });
    }
}
