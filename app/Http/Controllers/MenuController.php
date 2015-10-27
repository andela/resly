<?php

namespace Resly\Http\Controllers;

use Resly\Category;
use Illuminate\Http\Request;
use Resly\MenuItem;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->authorize('setup-restaurant');
    }

    /**
     * GET view for adding a menu.
     */
    public function getAddBulk(Request $request)
    {
        $categories = Category::all();
        $restaurant_id = $request->session()->get('restaurant_id');

        return view(
            'menu.bulk',
            [
                'categories' => $categories,
                'restaurant_id' => $restaurant_id,
            ]
        );
    }

    public function postAddBulk(Request $request)
    {
        // if the request has no data, return error code
        if (! $request->isJson()) {
            return 'false';
        }

        if (0 === count($request->json()->get('menu_items'))) {
            return 'Add some menus atleast';
        }

        $json = $request->json();
        $menu_items = $json->get('menu_items');
        $restaurant_id = $json->get('restaurant_id');

        foreach ($menu_items as $menu_item) {
            $menu = new MenuItem();
            $menu->name = $menu_item['name'];
            $menu->cat_id = $menu_item['category'];
            $menu->restaurant_id = $restaurant_id;
            $menu->price = $menu_item['price'];
            $menu->description = $menu_item['description'];
            // Include adding of tags here.
            $menu->save();
        }

        return 'success';
    }
}
