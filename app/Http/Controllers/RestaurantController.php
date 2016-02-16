<?php

namespace Resly\Http\Controllers;

use Auth;
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
     * Display All restaurants.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $restaurants = Restaurant::where('user_id', Auth::user()->id)->get();

        return view('restaurant.index', compact('restaurants'));
    }

    public function show(Request $request)
    {
        $restaurant = Restaurant::where('id', $request->restaurant_id)->get()->first();

        return view('restaurant.show', compact('restaurant'));
    }

    /**
     *  Display the form for adding a restaurant.
     */
    public function create()
    {
        return view('restaurant.create');
    }

    public function edit(Request $request, $restaurant_id)
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
                'description' => 'required',
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

        return redirect('restaurants');
    }
}
