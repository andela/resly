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
use willvincent\Rateable\Rating;

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
        $this->authorize('restaurateur-user');
        $restaurants = Restaurant::where('user_id', Auth::user()->id)->get();

        return view('restaurant.index', compact('restaurants'));
    }

    /**
     * Displays view for all users, logged in or nothing.
     * @param  Request $request request oci_fetch_object
     * @return View           view to display
     */
    public function showRestaurant(Request $request)
    {
        $restaurant = Restaurant::find($request->id);

        return view('restaurant.page', compact('restaurant'));
    }

    /**
     * Shows restaurants owned by a restaurant owner with given ID.
     * @param  Request          $request          request object
     * @param  TablesRepository $tablesRepository repository for getting table properties
     * @return View                             view to render
     */
    public function show(Request $request, TablesRepository $tablesRepository)
    {
        $this->authorize('restaurateur-user');
        $tables = $tablesRepository->getRestaurantTables($request->restaurant_id);
        $restaurant = Restaurant::where('id', $request->restaurant_id)->get()->first();

        return view('restaurant.show', compact('restaurant', 'tables'));
    }

    /**
     * Displays gallery of a restaurant.
     * @param  Request $request request object
     * @return View           view to render
     */
    public function showGallery(Request $request)
    {
        $restaurant = Restaurant::find($request->id);
        $pictures = $restaurant->pictures()->get();

        return view('restaurant.show_gallery', compact('restaurant', 'pictures'));
    }

    /**
     * Displays list of visited restaurant by logged in user.
     * @param  Request $request request object
     * @return View           view to render
     */
    public function visited(Request $request)
    {
        $this->authorize('diner-user');
        //$tables = $tablesRepository->getRestaurantTables($request->restaurant_id);
        $visitedRestaurants = Booking::where('user_id', Auth::user()->id)->get();

        return view('restaurant.visited', compact('visitedRestaurants'));
    }

    /**
     * Displays view for adding restaurant for a restaurateur.
     * @return View view to render
     */
    public function create()
    {
        $this->authorize('restaurateur-user');

        return view('restaurant.create');
    }

    /**
     * Renders view to edit a restaurant created by logged in user.
     * @param  Request $request       request object
     * @param  int  $restaurant_id id of restaurnat to edit
     * @return View                 View to render
     */
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

    /**
     * Saves a restaurant edit to the database.
     * @param  Request $request       request object
     * @param  int  $restaurant_id restauant id to save
     * @return View                 view to render
     */
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
     * Not currently used: Receive post requests from the add form submission.
     * @param  Request $request request object
     * @return View            view to render
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
     * Fetch nearby restaurant.
     * @param  Request $request request object
     * @return View           view to render
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
     * convert model results into assoc array.
     * @param  array $records array to convert
     * @param  int $lat     latitude
     * @param  int $lng     longitude
     * @return array          data result
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
            $output[$i]['avatar'] = ($record->pictures()->first()) == null ?
                asset('img/no-image-placeholder.jpg') :
                'http://res.cloudinary.com/ddnvpqjmh/image/upload/c_fill,h_300,w_300/'.$record->pictures()->first()->filename;
            $i++;
        }

        return $output;
    }

    /**
     * Calculate distance between.
     * @param  int  $point1_lat  latitue of point 1
     * @param  int  $point1_long  longitude of point 1
     * @param  int  $point2_lat  latitude of point 2
     * @param  int  $point2_long longitude of point 2
     * @param  string  $unit        unit of measurement
     * @param  int $decimals    [description]
     * @return int               distance between the two points
     */
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
     * Gets the coordinates of a point.
     * @param  string $location location of point to fetch coordinates for
     * @return array           of longitude and latitude
     */
    private function fetchCoordinates($location)
    {
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://maps.googleapis.com/maps/api/geocode/']);
        $getQueryStr = 'json?address='.urlencode($location).'&key='.env('GOOGLE_API_KEY');
        $response = $client->get($getQueryStr);

        $results = json_decode($response->getBody(), true, 512);

        return $results['results'][0]['geometry']['location'];
    }

    public function rateRestaurant(Request $request)
    {
        //fetch restaurant instance and user rating
        $restaurant = Restaurant::find($request->restaurant_id);
        $user_rating = intval($request->input('rate'));

        //if user has already rated update current rating, else save new rating
        if ($restaurant->userHasNotRated()) {
            $rating = new Rating;
            $rating->rating = $user_rating;
            $rating->user_id = Auth::user()->id;

            $restaurant->ratings()->save($rating);
        } else {
            $rating = Rating::where('user_id', Auth::user()->id)
                            ->where('rateable_id', $request->restaurant_id)->first();
            $rating->rating = $user_rating;
            $rating->save();
        }

        $output['status'] = 'success';
        $output['avg_rating'] = $restaurant->averageRating();

        return json_encode($output);
    }
}
