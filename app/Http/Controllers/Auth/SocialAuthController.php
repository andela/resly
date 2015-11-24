<?php

namespace Resly\Http\Controllers\Auth;

use Illuminate\Http\Request;

use Resly\Http\Requests;
use Resly\Http\Controllers\Controller;
use Resly\User;

use Socialite;
use Auth;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::with($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        $nativeUsers = User::where([
            'provider_name' => $provider,
            'provider_id' => $socialUser->id,
        ])->take(1)->get();

        if (count($nativeUsers) == 0) {
            $nativeUser = new User();

            $nativeUser->username = $socialUser->name;
            $nativeUser->email = $socialUser->email;
            $nativeUser->role = 'undecided';
            $nativeUser->avatarURL = $socialUser->avatar;
            $nativeUser->provider_name = 'google';
            $nativeUser->provider_id = $socialUser->id;

            $nativeUser->save();

            return redirect()->route('register');
        } else {
            $nativeUser = $nativeUsers[0];
        }

        Auth::login($nativeUser);

        if ($nativeUser->role == "restarateur") {
            return redirect()->route('resthome');
        } else if ($nativeUser->role == "diner") {
            return redirect()->route('dinerhome');
        }

        return redirect('/');
    }
}
