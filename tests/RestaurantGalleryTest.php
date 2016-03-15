<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;

class RestaurantGalleryTest extends TestCase
{
	use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
    */ 

    public function testAddGalleryPageIsLoaded()
    {
        /**
    	   This should test if the gallery page is created.
        **/
    }

    public function testFileUpload()
    {
        /**
            This should test that images can be uploaded on the gallery page.
        **/
    }
    
}
//
