<?php

namespace Resly\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Resly\Http\Requests;
use Resly\Http\Controllers\Controller;
use Resly\Restaurateur;

class RestAuthController extends Controller
{
   public function getRestSignup()
    {
        return view('auth.rest.signup');
    }

    public function postRestSignup(Request $request)
    {
        $this->validate($request, [
            'fname' => 'required|max:20|alpha_dash',
            'lname' => 'required|max:20|alpha_dash',
            'email' => 'required|unique:Restaurateur|email|max:255',
            'password' => 'required|min:6',
            'confirm-password' => 'required|same:password',
        ]);
        
        Restaurateur::create([
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);

        return redirect()->route('resthome')->with('info', 'You can now login');
    }

    public function getRestSignin()
    {
        return view('auth.rest.signin');
    }

    public function postRestSignin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        if (!Auth::restaurateur()->attempt($request->only(['email', 'password']),
            $request->has('remember'))) {
            return redirect()->back()->with('info', 'Could not sign you 
                in with those credentials.');
        }
        return redirect()->route('resthome')->with('info', 'You are now signed in');
    }

    public function getRestSignout()
    {
        Auth::restaurateur()->logout();
        return redirect()->route('restsignin');
    }
}
