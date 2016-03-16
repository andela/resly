<?php

namespace Resly\Http\Controllers;

use Resly\Restaurant;

class HomeController extends Controller
{
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
        $latestRestaurants = Restaurant::all()->sortByDesc('date_created')->take(12);
        $featuredRestaurants = Restaurant::all()->take(10);

        return view('welcome', compact('latestRestaurants', 'featuredRestaurants'));
    }

    public function aboutUs()
    {
        return view('aboutus');
    }

    public function contactUs()
    {
        return view('contactus');
    }
}
