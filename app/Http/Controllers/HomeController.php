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
}
