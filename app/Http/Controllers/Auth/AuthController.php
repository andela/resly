<?php

namespace Resly\Http\Controllers\Auth;

use Resly\User;
use Auth;
use Resly\Http\Controllers\Controller;
use Resly\Http\Requests\RegisterTraditionallyRequest;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  RegisterTraditionallyRequest $request
     * @return response
     */
    public function registerUser(RegisterTraditionallyRequest $request)
    {
        User::create([
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()
          ->route('homepage')
          ->with('info', 'Registration successfull. Now log in');
    }
}
