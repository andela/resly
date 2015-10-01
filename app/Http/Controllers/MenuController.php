<?php

namespace Resly\Http\Controllers;

use Resly\Category;

class MenuController extends Controller
{
    /**
     * GET view for adding a menu.
     */
    public function getAddBulk()
    {
        $categories = Category::all();
        return view('menu.bulk',
            ['categories' => $categories]);
    }
}
