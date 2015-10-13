<?php

namespace Resly\Http\Controllers;

use Resly\Restaurant;

class ProfileController extends Controller
{
    public function getProfile($id)
    {
        $rest = Restaurant::where('id', $id)->first();
        return view('profile.index')
        ->with('rest', $rest);
    }
}
