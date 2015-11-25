<?php

namespace Resly\Http\Controllers\Auth;

use Illuminate\Http\Request;

use Resly\Http\Requests;
use Resly\Http\Controllers\Controller;

use Auth;

class SocialRegistrationController extends Controller
{
    public function __public()
    {
        $this->middleware('auth');
    }

    public function getRegistration()
    {
        return view('social.register');
    }

    public function postRegistration(Requests\SocialRegistrationRequest $request)
    {
        $user = Auth::user();

        $user->role = $request->input('role');
        $user->fname = $request->input('fname');
        $user->lname = $request->input('lname');

        $user->save();

        Auth::logout($user);

        if ($user->role == 'diner') {
            return redirect()->route('dinerhome');
        }

        if ($user->role == 'restaurateur') {
            return redirect()->route('resthome');
        }
    }
}
