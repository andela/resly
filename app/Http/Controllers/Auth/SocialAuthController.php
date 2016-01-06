<?php

namespace Resly\Http\Controllers\Auth;

use Auth;
use Socialite;
use Resly\User;
use Resly\Http\Controllers\Controller;

class SocialAuthController extends Controller
{
    /**
     * redirect to provider oauth url.
     *
     * @param  $provider name of provider
     *
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
     *
     * @return redirect to homepage
     */
    public function handleProviderCallback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        $nativeUser = User::where('email', $socialUser->email)->first();

        if ($nativeUser == null) {
            self::beginRegistration($socialUser, $provider);

            return redirect()->route('social.register')->with('you need to register first');
        }

        Auth::login($nativeUser);

        return redirect('/');
    }

    /**
     * save social provider data to session.
     *
     * @param  $user user from socialite
     * @param  $provider name of provider
     */
    public static function beginRegistration($user, $provider)
    {
        session([
            'username' => $user->name,
            'email' => $user->email,
            'avatar_url' => $user->avatar,
            'provider_name' => $provider,
            'provider_id' => $user->id,
        ]);
    }
}
