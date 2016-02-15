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

    public function testAddTable()
    {
        $restaurateur = factory('Resly\User')->create(
            ['role' => 'restaurateur']
        );

        $restaurant = factory(Resly\Restaurant::class)->create();


        $this->actingAs($restaurateur)
            ->visit("/restaurants/$restaurant->id/tables")
            ->type('Rose Petals', 'label')
            ->type(4, 'seats_number')
            ->type(4, 'cost')
            ->press('Add');

        $this->seeInDatabase(
            'tables',
            ['label' => 'Rose Petals']
        );
    }

    public function testUpdateTable()
    {
        $restaurateur = factory('Resly\User')->create(
            ['role' => 'restaurateur']
        );

        $restaurant = factory(Resly\Restaurant::class)->create();
        $table = factory(Resly\Table::class)->create([
            'restaurant_id'=>$restaurant->id
        ]);


        $this->actingAs($restaurateur)
            ->visit("/tables/$table->id/edit")
            ->type('Rose Petals', 'label')
            ->type(4, 'seats_number')
            ->type(4, 'cost')
            ->press('Save');

        $this->dontSeeInDatabase(
            'tables',
            ['label' => $table->label]
        );
    }


    public function testDeleteTable()
    {
         $restaurateur = factory('Resly\User')->create(
             ['role' => 'restaurateur']
         );

        $restaurant = factory(Resly\Restaurant::class)->create();
        $table = factory(Resly\Table::class)->create([
            'restaurant_id'=>$restaurant->id
        ]);


        $this->actingAs($restaurateur)
            ->visit("/restaurants/$restaurant->id/")
            ->press('delete');

        $this->dontSeeInDatabase(
            'tables',
            ['label' => $table->label]
        );
    }

}
