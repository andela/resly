<?php

namespace Resly\Http\Controllers;

use Resly\App\Restaurateur;
use Resly\Restaurant;
use Auth;

class RestaurateurProfileController extends Controller
{
    public function getProfile()
    {
        $user = Auth::user();
        $restaurant = $user->restaurant;

        return view('restaurateur.profile', [
            'restaurateur' => $user,
            'restaurant' => $restaurant,
        ]);
    }
}
