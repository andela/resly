<?php

namespace Resly\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Resly\Repositories\TablesRepository;
use Illuminate\Http\Response;
use Validator;
use Resly\Restaurant;
use Resly\Booking;
use Resly\Http\Requests;

class RestaurantController extends Controller
{
    public function __construct()
    {
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

    public function showRestaurant(Request $request){
        $restaurant = Restaurant::find($request->id);
        return view('restaurant.page', compact('restaurant'));
    }

    public function show(Request $request, TablesRepository $tablesRepository)
    {
        $tables = $tablesRepository->getRestaurantTables($request->restaurant_id);
        $restaurant = Restaurant::where('id', $request->restaurant_id)->get()->first();

        return view('restaurant.show', compact('restaurant', 'tables'));
    }

    public function showGallery(Request $request)
    {
        $restaurant = Restaurant::find($request->id);
        $pictures = $restaurant->pictures()->get();
        return view('restaurant.show_gallery', compact('restaurant', 'pictures'));
    }

    public function visited(Request $request)
    {

        //$tables = $tablesRepository->getRestaurantTables($request->restaurant_id);
        $visitedRestaurants = Booking::where('user_id', Auth::user()->id)->get();
        
        return view('restaurant.visited', compact('visitedRestaurants'));
    }

    /**
     *  Display the form for adding a restaurant.
     */
    public function create()
    {
        $this->authorize('restaurateur-user');

        return view('restaurant.create');
    }

    public function edit(Request $request, $restaurant_id)
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

    public function createEdit(Request $request, $restaurant_id)
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
    public function createAdd(Request $request)
    {
        $this->authorize('restaurateur-user');
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

        //add longitude and latitude coordinates to database
        $location = $this->fetchCoordinates($restaurant->location);
        $restaurant->longitude = $location['lng'];
        $restaurant->latitude = $location['lat'];
        $restaurant->save();

        return redirect('restaurants');
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
