<?php

namespace Resly\Http\Controllers;

use Resly\User;

class UserProfileController extends Controller
{
    public function getProfile($username)
    {
        return view('profile.user');
    }
}
