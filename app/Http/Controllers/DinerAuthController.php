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
        return view('auth.diner.signup');
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
        return view('auth.diner.signin');
    }

    public function postDinerSignin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        if (!Auth::diner()->attempt(
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
     * Redirect the user to the google authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from google.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (Exception $e) {
            return Redirect::to('auth/google');
        }

        $authUser = $this->findOrCreateUser($user);

        Auth::diner()->login($authUser, true);

        return redirect()->route('dinerhome');
    }

    /**
     * Return user if exists; create and return if doesn't.
     *
     * @param $googleUser
     *
     * @return User
     */
    private function findOrCreateUser($googleUser)
    {
        if ($authUser = Diner::where('google_id', $googleUser->id)->first()) {
            return $authUser;
        }

        return Diner::create([
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'google_id' => $googleUser->id,
            'avatar' => $googleUser->avatar,
        ]);
    }
}
