<?php

namespace Resly\Http\Controllers;

use Illuminate\Http\Request;

use Resly\User;
use Resly\Http\Requests;
use Resly\Http\Controllers\Controller;

class UserProfileController extends Controller
{
    public function getProfile($username)
    {
        return view('profile.user');
    }
}
