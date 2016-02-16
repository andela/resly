<?php

namespace Resly\Http\Controllers;

use Resly\Restaurant;
use Resly\Rating;
use Auth;

class ProfileController extends Controller
{
    public function getProfile($id)
    {
        $rest = Restaurant::where('id', $id)->first();

        if(Auth::check()){
        	$user_rating = Rating::where('user_id', Auth::user()->id)
        						->where('rateable_id', $rest->id)->first()->rating;
        } else {
        	$user_rating = "Sign in to rate";
        }


        return view('profile.index')
        ->with('rest', $rest)
        ->with('user_rating', $user_rating);
    }
}
