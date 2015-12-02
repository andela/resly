<?php

namespace Resly\Http\Controllers;

use Illuminate\Http\Request;

use Resly\Http\Requests;
use Resly\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showDashboard()
    {
        return view('dashboard.index');
    }
}
