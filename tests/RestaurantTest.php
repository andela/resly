<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RestaurantTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * Test the adding of restaurants
     *
     * @return void
     */

    public function _setUp()
    {
        $this->restaurateur = factory('Resly\Restaurateur')->make();
    }

    public function _testAddRestaurantPageIsLoaded()
    {
        $this->actingAs($this->restaurateur)
            ->visit('/restaurants/add')
            ->see('Add the details of the restaurant');
    }

    public function _testRestaurantIsAdded()
    {
        $this->actingAs($this->restaurateur)
            ->visit('/restaurants/add')
            ->type('My First Restaurant', 'name')
            ->type('We are awesome', 'description')
            ->type('08:00:00', 'opening_time')
            ->type('17:00:00', 'closing_time')
            ->type('Nairobi West', 'location')
            ->type('+2517238293', 'telephone')
            ->type('first.rest@resly.com', 'email')
            ->type('50504, Nairobi', 'address')
            ->press('Next')
            ->see('Add the Tables\' details');

        $this->seeInDatabase('Restaurant', 
            ['email' => 'first.rest@resly.com']);

        // Return the database to its state before the adding
        
        DB::table('Restaurant')->where('email', '')
          ->delete('first.rest@resly.com');

    }
    
    public function testRestaurantDatabase()
    {
        DB::transaction(function () {
            // Seed some data and delete it afterwards
            $restaurant = factory('Resly\Restaurant')->make();

            DB::table('Restaurant')->insert($restaurant->getAttributes());
            $this->seeInDatabase(
                'Restaurant', ['email' => $restaurant->email]
            );

            DB::table('Restaurant')->where('email', $restaurant->email)
                ->delete();
        });
    }
}
