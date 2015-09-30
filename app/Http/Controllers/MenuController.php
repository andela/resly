<?php

namespace Resly\Http\Controllers;

class MenuController extends Controller
{
    /**
     * GET view for adding a menu.
     */
    public function getAddBulk()
    {
        return view('menu.add');
    }
}
