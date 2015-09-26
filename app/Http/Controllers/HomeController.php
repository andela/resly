<?php

namespace Resly\Http\Controllers;

use Illuminate\Http\Request;
use Resly\Http\Requests;
use Resly\Http\Controllers\Controller;

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
