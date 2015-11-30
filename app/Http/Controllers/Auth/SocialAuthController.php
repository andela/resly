<?php

namespace Resly\Http\Controllers\Auth;

use Illuminate\Http\Request;

use Socialite;
use Auth;

use Resly\Http\Requests;
use Resly\Http\Controllers\Controller;
use Resly\User;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::with($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        $nativeUser = User::firstOrNew([
            'provider_name' => $provider,
            'provider_id' => $socialUser->id,
        ]);

        if (!$nativeUser->exists) {
            $nativeUser->username = $socialUser->name;
            $nativeUser->email = $socialUser->email;
            $nativeUser->avatar_url = $socialUser->avatar;
            $nativeUser->provider_name = $provider;
            $nativeUser->provider_id = $socialUser->id;

            $nativeUser->save();
        }

        Auth::login($nativeUser);

        if ($nativeUser->role == "restarateur") {
            return redirect()->route('resthome');

        } else if ($nativeUser->role == "diner") {
            return redirect()->route('dinerhome');

        } else {
            return redirect()->route('getSocialRegister');

        }

        return redirect('/');
    }
}
