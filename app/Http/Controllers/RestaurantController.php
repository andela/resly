<?php

namespace Resly\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Resly\Restaurant;
use Resly\Http\Requests;
use Resly\Http\Controllers\Controller;

class RestaurantController extends Controller
{
    /**
    *  Display the restaurant listing
    */
    public function getIndex()
    {

    }

    /** 
    *  Display the form for adding a restaurant
    */

    public function getAdd()
    {
        return view('restaurant.add');
    }

    /**
    *  Receive post requests from the add form submission
    */

    public function postAdd(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'opening_time' => array('regex:/^[0-9]{2}:[0-9]{2}.*$/'),
                'closing_time' => array('regex:/^[0-9]{2}:[0-9]{2}.*$/'),
                'location' => 'required',
                'telephone' => 'required|numeric',
                'email' => 'required|email',
                'address' => 'required'
            ]
        );

        if($validator->fails()) {
            return redirect('/restaurants/add')
                ->withErrors($validator);
        }

        $restaurant = Restaurant::create($request->all());
        return redirect('tables/add-bulk');
    }
}
