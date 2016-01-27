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

    public function testAddRestaurantPageIsLoaded()
    {
        $restaurateur = factory('Resly\User')->create(
            ['role' => 'restaurateur']
        );

        $this->actingAs($restaurateur)
            ->visit('/restaurants')
            ->see('You have no restaurants yet')
            ->see('Create Your First Restaurant');
    }

    public function testRestaurantIsAdded()
    {
        $restaurateur = factory('Resly\User')->create(
            ['role' => 'restaurateur']
        );

        $this->actingAs($restaurateur)
            ->visit('/restaurants/create')
            ->type('My First Restaurant', 'name')
            ->type('We are awesome', 'description')
            ->type('08:00:00', 'opening_time')
            ->type('17:00:00', 'closing_time')
            ->type('Nairobi West', 'location')
            ->type('+2517238293', 'telephone')
            ->type('first.rest@resly.com', 'email')
            ->type('50504, Nairobi', 'address')
            ->press('Save')
            ->see('My First Restaurant');

        $this->seeInDatabase(
            'restaurants',
            ['email' => 'first.rest@resly.com']
        );

//         Return the database to its state before the adding
        
        DB::table('restaurants')->where('email', 'first.rest@resly.com')
          ->delete();

    }

    public function testRestaurantIsEdited()
    {
        $restaurateur = factory('Resly\User')->create(
            ['role' => 'restaurateur']
        );
        $restaurant = factory('Resly\Restaurant')->create();

        $this->actingAs($restaurateur)
            ->visit("/restaurants/edit/{$restaurant->id}")
            ->type('My First Restaurant', 'name')
            ->type('We are awesome', 'description')
            ->type('08:00:00', 'opening_time')
            ->type('17:00:00', 'closing_time')
            ->type('Nairobi West', 'location')
            ->type('+2517238293', 'telephone')
            ->type('edited.rest@resly.com', 'email')
            ->type('50504, Nairobi', 'address')
            ->press('Next');

        $this->seeInDatabase(
            'restaurants',
            ['email' => 'edited.rest@resly.com']
        );

    }
    
    public function testRestaurantDatabase()
    {
        DB::transaction(function () {
            // Seed some data and delete it afterwards
            $restaurant = factory('Resly\Restaurant')->make();

            DB::table('restaurants')->insert($restaurant->getAttributes());
            $this->seeInDatabase(
                'restaurants',
                ['email' => $restaurant->email]
            );

            DB::table('restaurants')->where('email', $restaurant->email)
                ->delete();
        });
    }
}
