<?php

namespace Resly\Http\Controllers;

use Resly\Repositories\RestaurantRepository;

class HomeController extends Controller
{
    protected $restaurant;

    public function __construct(RestaurantRepository $restaurant)
    {
        $this->restaurant = $restaurant;
    }

    public function resthome()
    {
        return view('rest.home');
    }

    public function dinerhome()
    {
        return view('diner.home');
    }

    public function register()
    {
        return view('auth_manual.register');
    }

    public function login()
    {
        return view('auth_manual.login');
    }

    public function homepage()
    {
        $latestRestaurants = $this->restaurant->sortByDesc('date_created')->take(12);

        $featuredRestaurants = $this->restaurant->getAll()->take(10);

        return view('welcome', compact('latestRestaurants', 'featuredRestaurants'));
    }
}
