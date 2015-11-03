<?php

namespace Resly\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Resly\Diner;
use Socialite;
use Redirect;

class DinerAuthController extends Controller
{
    public function getDinerSignup()
    {
        return view('diner.home');
    }

    public function postDinerSignup(Request $request)
    {
        $this->validate($request, [
            'fname' => 'required|max:20|alpha_dash',
            'lname' => 'required|max:20|alpha_dash',
            'email' => 'required|unique:Diner|email|max:255',
            'password' => 'required|min:6',
            'confirm-password' => 'required|same:password',
        ]);

        Diner::create([
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()->route('dinerhome')->with('info', 'You can now login');
    }

    public function getDinerSignin()
    {
        return view('diner.home');
    }

    public function postDinerSignin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        if (! Auth::diner()->attempt(
            $request->only(['email', 'password']),
            $request->has('remember')
        )) {
            return redirect()->route('dinerhome')->with('info', 'Could not sign you 
                in with those credentials.');
        }
        $request->session()->put('user_id', Auth::diner()->get()->id);

        return redirect()->route('dinerhome')->with('info', 'You are now signed in');
    }

    public function getDinerSignout()
    {
        Auth::diner()->logout();

        return redirect()->route('dinerhome');
    }

    /**
     * Redirect the user to the social authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from social.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return Redirect::to('auth/{provider}');
        }

        $authUser = $this->findOrCreateUser($user);

        Auth::diner()->login($authUser, true);

        return redirect()->route('dinerhome');
    }

    /**
     * Return user if exists; create and return if doesn't.
     *
     * @param $socialUser
     *
     * @return User
     */
    private function findOrCreateUser($socialUser)
    {
        if ($authUser = Diner::where('social_id', $socialUser->id)->first()) {
            return $authUser;
        }

        return Diner::create([
            'name' => $socialUser->name,
            'email' => $socialUser->email,
            'social_id' => $socialUser->id,
            'avatar' => $socialUser->avatar,
        ]);
    }
}
