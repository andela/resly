<?php

namespace Resly\Http\Controllers;

use Illuminate\Http\Request;
use Resly\Restaurant;
use Resly\Rating as Ratings;
use willvincent\Rateable\Rating;

class RatingsController extends Controller
{
    public function __construct()
    {
        $this->authorize('authenticated');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rate(Request $request, $restaurant_id)
    {
        $restaurant = Restaurant::find($restaurant_id);
        $rating = $request->input('rating');

        if ($restaurant->userHasNotRated()) {
            $this->rateRestaurant($request->user(), $restaurant, $rating);
            $result = ['output' => 1, 'ratings_avg' => $restaurant->averageRating()];
        } else {
            $result = ['output' => 0];
        }

        return json_encode($result);
    }

    private function rateRestaurant($user, $restaurant, $ratings)
    {
        $rating = new Rating;
        $rating->user_id = $user->id;
        $rating->rating = $ratings;

        $restaurant->ratings()->save($rating);
    }
}
