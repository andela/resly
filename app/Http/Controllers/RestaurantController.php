<?php

namespace Resly\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Resly\Restaurant;
use Resly\Http\Requests;

class RestaurantController extends Controller
{
    public function __construct()
    {
        $this->authorize('restaurateur-user');
    }

    /**
     *  Display the form for adding a restaurant.
     */
    public function add()
    {
        return view('restaurant.add');
    }

    public function edit($restaurant_id)
    {
        $restaurant = Restaurant::find($restaurant_id);
        if ($restaurant) {
            return view('restaurant.edit', [
                'restaurant' => $restaurant,
            ]);
        } else {
            abort(404);
        }
    }

    public function createEdit(Request $request, $restaurant_id)
    {
        $restaurant = Restaurant::find($restaurant_id);

        if ($restaurant_id) {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'opening_time' => ['regex:/^[0-9]{2}:[0-9]{2}.*$/'],
                    'closing_time' => ['regex:/^[0-9]{2}:[0-9]{2}.*$/'],
                    'location' => 'required',
                    'telephone' => 'required|numeric',
                    'email' => 'required|email',
                    'address' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect('/restaurants/edit')
                    ->withInput()
                    ->withErrors($validator);
            }

            $restaurant->fill($request->all());
            $restaurant->save();
            $user = auth()->user();
            $username = $user->username;

            return redirect('/dashboard');
        } else {
            abort(404);
        }
    }

    /**
     *  Receive post requests from the add form submission.
     */
    public function createAdd(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'opening_time' => ['regex:/^[0-9]{2}:[0-9]{2}.*$/'],
                'closing_time' => ['regex:/^[0-9]{2}:[0-9]{2}.*$/'],
                'location' => 'required',
                'telephone' => 'required|numeric',
                'email' => 'required|email',
                'address' => 'required',
            ]
        );

        if ($validator->fails()) {
            return redirect('/restaurants/add')
                ->withInput()
                ->withErrors($validator);
        }

        $restaurateur = \Auth::user();
        $restaurant = $restaurateur->restaurant()->create($request->all());
        $request->session()->put('restaurant_id', $restaurant->id);

        return redirect('tables/add-bulk');
    }
}
