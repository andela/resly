<?php

namespace Resly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Resly\Restaurant;
use Resly\Http\Requests;

class RestaurantController extends Controller
{
    public function __construct()
    {
    }

    /**
     *  Display the form for adding a restaurant.
     */
    public function getAdd()
    {
        $this->authorize('restaurateur-user');

        return view('restaurant.add');
    }

    public function getEdit($restaurant_id)
    {
        $this->authorize('restaurateur-user');

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
        $this->authorize('restaurateur-user');
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
        $this->authorize('restaurateur-user');
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

    public function getTest()
    {
        $address = '361, Herbert Macaulay Way, Yaba, Lagos, Nigeria';
        $coord_1 = $this->fetchCoordinates($address);
        $coord_2 = ['lat' => 6.5001035, 'lng' => 3.3788857];

        return $this->calcDistance($coord_1['lat'], $coord_1['lng'],
            $coord_2['lat'], $coord_2['lng'], 'km', 2
        );
    }

    /**
     * Fetch Nearby restaurants.
     */
    public function postCloseby(Request $request)
    {
        //fetch longitude and latitude
        $lat = $request->input('latitude');
        $lng = $request->input('longitude');

        //fetch restaurants within that area
        $restaurants = Restaurant::where('latitude', '>', $lat - 0.2)
        ->where('latitude', '<', $lat + 0.2)
        ->where('longitude', '>', $lng - 0.2)
        ->where('longitude', '<', $lng + 0.2)
        ->take(10)
        ->get();

        //prepare results in json and push
        if (count($restaurants) > 0) {
            $output = $this->constructAssoc($restaurants, $lat, $lng);

            return response(json_encode($output))->header('Content-Type', 'application/json');
        } else {
            return 'nothing found';
        }
    }

    /**
     * conver model results into assoc array.
     */
    private function constructAssoc($records, $lat, $lng)
    {
        $output = [];
        $i = 0;
        foreach ($records as $record) {
            $output[$i]['id'] = $record->id;
            $output[$i]['name'] = $record->name;
            $output[$i]['description'] = $record->description;
            $output[$i]['location'] = $record->location;
            $output[$i]['distance'] = $this->calcDistance($lat, $lng,
                $record->latitude, $record->longitude, 'km', 3);
            $i++;
        }

        return $output;
    }

    private function calcDistance(
        $point1_lat, $point1_long,
        $point2_lat, $point2_long,
        $unit = 'km', $decimals = 2)
    {

        // Calculate the distance in degrees using Hervasine formula
        $degrees = rad2deg(acos((sin(deg2rad($point1_lat)) *
            sin(deg2rad($point2_lat))) +
        (cos(deg2rad($point1_lat)) *
            cos(deg2rad($point2_lat)) *
            cos(deg2rad($point1_long - $point2_long)))));

        // Convert the distance in degrees to the chosen unit (kilometres, miles or nautical miles)

        switch ($unit) {
            case 'km':
                // 1 degree = 111.13384 km, based on the average diameter of the Earth (12,735 km)
                $distance = $degrees * 111.13384;
                break;
            case 'mi':
                // 1 degree = 69.05482 miles, based on the average diameter of the Earth (7,913.1 miles)
                $distance = $degrees * 69.05482;
                break;
            case 'nmi':
                // 1 degree = 59.97662 nautic miles, based on the average diameter of the Earth (6,876.3 nautical miles)
                $distance = $degrees * 59.97662;
        }

        return round($distance, $decimals);
    }

    /**
     * fetch coordinates.
     */
    private function fetchCoordinates($location)
    {
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://maps.googleapis.com/maps/api/geocode/']);
        $getQueryStr = 'json?address='.urlencode($location).'&key='.env('GOOGLE_API_KEY');
        $response = $client->get($getQueryStr);

        $results = json_decode($response->getBody(), true, 512);

        return $results['results'][0]['geometry']['location'];
    }
}
