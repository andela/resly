<?php

namespace Resly\Http\Controllers;

use Resly\Repositories\RestaurantRepository;

class ProfileController extends Controller
{
    protected $restaurant;

    public function __construct(RestaurantRepository $restaurant)
    {
        $this->restaurant = $restaurant;
    }

    public function getProfile($id)
    {
        $rest = $this->restaurant->getFirstBy('id', $id);

        return view('profile.index')
        ->with('rest', $rest);
    }
}
