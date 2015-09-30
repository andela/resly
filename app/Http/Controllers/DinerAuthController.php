<?php

namespace Resly\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Resly\Diner;

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
        if (! Auth::diner()->attempt(
            $request->only(['email', 'password']),
            $request->has('remember')
        )) {
            return redirect()->route('dinerhome')->with('info', 'Could not sign you 
                in with those credentials.');
        }

        return redirect()->route('dinerhome')->with('info', 'You are now signed in');
    }

    public function getDinerSignout()
    {
        Auth::diner()->logout();

        return redirect()->route('dinerhome');
    }
}
