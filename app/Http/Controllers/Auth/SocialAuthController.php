<?php

namespace Resly\Http\Controllers\Auth;

use Illuminate\Http\Request;

use Resly\Http\Requests;
use Resly\Http\Controllers\Controller;

use Socialite;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::with($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        return dd($user);
    }
}
