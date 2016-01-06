<?php

namespace Resly\Http\Controllers\Profile\Restauranteur;

use Illuminate\Http\Request;

use Resly\Http\Requests;
use Resly\Http\Controllers\Controller;

class RestaurantController extends Controller
{
    public function getRegister(){
        return view('Restauranteur.addRestaurant');
    }
}
