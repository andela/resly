<?php

namespace Resly\Http\Controllers;

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
        return view('register');
    }

    public function login()
    {
        return view('login');
    }

    public function homepage()
    {
        return view('welcome');
    }
}
