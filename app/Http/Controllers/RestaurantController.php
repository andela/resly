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
    public function getAdd()
    {
        return view('restaurant.add');
    }

    public function getEdit($restaurant_id)
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

    public function postEdit(Request $request, $restaurant_id)
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
    public function postAdd(Request $request)
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

        //add longitude and latitude coordinates to database
        $location = $this->fetchCoordinates($restaurant->location);
        $restaurant->longitude = $location['lng'];
        $restaurant->latitude = $location['lat'];
        $restaurant->save();

        return redirect('tables/add-bulk');
    }



    /**
     * fetch coordinates
     */
    private function fetchCoordinates($location)
    {
        $client = new \GuzzleHttp\Client(['base_uri'=> 'https://maps.googleapis.com/maps/api/geocode/']);
        $getQueryStr = 'json?address=' . urlencode($location) . '&key=' . env('GOOGLE_API_KEY') ;
        $response = $client->get($getQueryStr);

        $results = json_decode($response->getBody(), true, 512);
        return $results['results'][0]['geometry']['location'];
    }
}
