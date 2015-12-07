<?php

namespace Resly\Http\Controllers;

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
