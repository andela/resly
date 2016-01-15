<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;

class RestaurantGalleryTest extends TestCase
{
	//use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
    */ 

    public function testAddGalleryPageIsLoaded()
    {
    	$restaurateur = factory('Resly\User')->create(
            ['role' => 'restaurateur']
        );

        $this->actingAs($restaurateur)
            ->visit('/gallery')
            ->see('Gallery');
    }

    public function testFileUpload()
    {
        $restaurateur = factory('Resly\User')->create(
            ['role' => 'restaurateur']
        );

        $caption = 'My New Beautiful Diner';
        $res = $this->actingAs($restaurateur)
        ->visit('/gallery')
        ->type($caption, 'caption')
        ->attach(public_path('img/diner.jpg'), 'image')
        ->press('Upload file');

        $this->seeInDatabase('restaurant_pictures', [
            'caption' => $caption,
            'restauranteur_id' => $restaurateur->id,
        ]);
    }
    
}
//