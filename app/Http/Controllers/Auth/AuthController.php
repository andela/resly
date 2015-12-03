<?php

namespace Resly\Http\Controllers\Auth;

use Validator;
use Resly\User;
use Resly\Http\Controllers\Controller;
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
     * Redirect path after authentication.
     */
    protected $redirectPath = '/';

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname'             => 'required|max:20|alpha_dash',
            'lname'             => 'required|max:20|alpha_dash',
            'role'              => 'required|in:diner,restaurateur',
            'username'          => 'required|unique:users|max:30|alpha_dash',
            'email'             => 'required|unique:users|email|max:255',
            'password'          => 'required|min:6',
            'confirm-password'  => 'required|same:password',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'fname'     => $data['fname'],
            'lname'     => $data['lname'],
            'username'  => $data['username'],
            'email'     => $data['email'],
            'role'      => $data['role'],
            'password'  => bcrypt($data['password']),
        ]);
    }
}
