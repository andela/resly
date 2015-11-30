<?php

namespace Resly\Http\Controllers\Auth;

use Illuminate\Http\Request;


use Auth;
use Socialite;
use Resly\User;
use Resly\Http\Requests;
use Resly\Http\Controllers\Controller;

class SocialAuthController extends Controller
{
    /**
     * redirect to provider oauth url
     *
     * @param  $provider name of provider
     * @return redirect to provider oauth url
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     *  handle a user who has successfuly authenticated
     *  with their social provider.
     *
     * @param  provider name of provider i.e 'google'
     * @return redirect to homepage
     */
    public function handleProviderCallback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        $nativeUser = self::findOrCreateUser($socialUser, $provider);

        // if this is the first time we are seeing
        // this we consider this to be a registration.
        if (!$nativeUser->exists) {
            self::beginRegistration($socialUser, $provider);
            return redirect()->route('social.register')->with('you need to register first');
        }

        Auth::login($nativeUser);

        return redirect('/');
    }

    /**
     *  returns a user from the database creating one
     *  if none existed.
     *
     * user data is based on data returned by social authenticator.
     *
     * @param  $socialUser user returned by social provider
     * @param  $provider name of provider
     * @return $user
     */
    public static function findOrCreateUser($socialUser, $provider)
    {
        $user = User::firstOrNew([
            'provider_name' => $provider,
            'provider_id'   => $socialUser->id,
        ]);

        return $user;
    }

    /**
     * save social provider data to session
     *
     * @param  $user user from socialite
     * @param  $provider name of provider
     * @return void
     */
    public static function beginRegistration($user, $provider)
    {
        session([
            'username'   => $user->name,
            'email'      => $user->email,
            'avatar_url' => $user->avatar,
            'provider_name' => $provider,
            'provider_id' => $user->id,
        ]);
    }
}
