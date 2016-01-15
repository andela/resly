<?php

namespace Resly\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
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
        $restauranteur_id = User::where('username', auth()->user()->username)->first()->id;
        $pictures = RestaurantPictures::where('restauranteur_id', intval($restauranteur_id))->get();
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
    public function store(Request $request, RestaurantPictures $picture, Response $response)
    {
        //get restauranteur id
        $restauranteur_id = User::where('username', auth()->user()->username)->first()->id;
          
        //fetch file location and upload to cloudinary
        $filepath = $request->file('image')->getPathName();

        
        $uploaded = $this->upload($filepath);

        //save picture information to database
        $picture->filename = $uploaded['public_id'].".".$uploaded['format'];
        $picture->caption = $request->get('caption');
        $picture->restauranteur_id = $restauranteur_id;
        $picture->save();
        $response->header('image-id', $picture->id);
        
        if (!$request->ajax()) {    
            //send flash message and redirect to gallery homepage
            flash()->success('Picture Uploaded!!');
            return redirect()->action('RestaurantGalleryController@index');    
        } else {
            //flash()->success('Picture Uploaded!!');
            return json_encode([
                'status' => 'successful',
                'pic_id' => $picture->id, 
                'filename' => $picture->filename, 
                'caption' => $picture->caption
            ]);
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
        $picture = RestaurantPictures::find($id);
        $result = $this->delete($picture);

        if ($result['result'] == 'ok') {
            echo 'Deleted successfully';
        } else {
            echo 'Failed to delete';
        }
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

    private function delete($image)
    {
        //delete image metadata from db
        RestaurantPictures::destroy($image->id);

        //delete image from cloudinary
        $res = \Cloudinary::config(array( 
          "cloud_name" => "ddnvpqjmh", 
          "api_key" => "911597418222643", 
          "api_secret" => "qgnRvc9ACfuMQjrm2dNmrKTCYqc" 
        ));
        $id = explode(".", $image->filename);
        $delete = \Cloudinary\Uploader::destroy($id[0]);
        return $delete;
    }
}
