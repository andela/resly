<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Resly\Wine;

class AddWineTest extends TestCase
{
    use DatabaseMigrations;

    public function testAddWine()
    {
        $restaurateur = factory('Resly\Restaurateur')->create();

        $this->actingAs($restaurateur)
             ->visit('/wines')
             ->see("Add New Wine");

        $this->seed('DatabaseSeeder');

        $wine = factory('Resly\Wine')->create();
    }
}
