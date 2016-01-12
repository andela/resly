<?php

namespace Resly\Http\Controllers;

use Resly\Http\Requests\GalleryPictureRequest;
use Resly\RestaurantPictures;
use Resly\User;
use Resly\Http\Requests;
use Resly\Http\Controllers\Controller;

class RestaurantGalleryController extends Controller
{

    public function __construct()
    {
        $this->authorize('restaurateur-user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pictures = RestaurantPictures::all();
        return view('restaurant.gallery', ['pictures' => $pictures]);      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryPictureRequest $request, RestaurantPictures $picture)
    {
        //get restauranteur id
        $restauranteur_id = User::where('username', auth()->user()->username)->first()->id;
          
        //fetch file location and upload to cloudinary
        $filepath = $_FILES['image']['tmp_name'];
        $uploaded = $this->upload($filepath);

        //save picture information to database
        $picture->filename = $uploaded['public_id'];
        $picture->caption = $request->get('caption');
        $picture->restauranteur_id = $restauranteur_id;
        $picture->save();
        
        if (!$request->ajax()) {    
            //send flash message and redirect to gallery homepage
            flash()->success('Picture Uploaded!! '.$restauranteur_id);
            return redirect()->action('RestaurantGalleryController@index');    
        } else {
            return "ajax req";
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function upload($filepath)
    {
        $res = \Cloudinary::config(array( 
          "cloud_name" => "ddnvpqjmh", 
          "api_key" => "911597418222643", 
          "api_secret" => "qgnRvc9ACfuMQjrm2dNmrKTCYqc" 
        ));
        $upload = \Cloudinary\Uploader::upload($filepath);
        return $upload;

    }
}
