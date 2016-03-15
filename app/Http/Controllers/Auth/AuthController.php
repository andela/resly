<?php

namespace Resly\Http\Controllers\Auth;

use Mail;
use Validator;
use Resly\User;
use Resly\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

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
     */
    public function __construct(Request $request)
    {
        $this->middleware('guest', ['except' => 'getLogout']);

        if ($request->session()->has('redirect_back')) {
            $this->redirectPath = $request->session()->get('redirect_back');
            $request->session()->forget('redirect_back');
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => 'required|max:20|alpha_dash',
            'lname' => 'required|max:20|alpha_dash',
            'role' => 'required|in:diner,restaurateur',
            'email' => 'required|unique:users|email|max:255',
            'password' => 'required|min:6',
            'confirm-password' => 'required|same:password',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => bcrypt($data['password']),
        ]);

        Mail::queue('email.welcome', ['user' => $user], function ($message) use ($user) {
            $message->to($user->email, $user->name)
                    ->subject('Welcome to Resly!');
        });

        return $user;
    }
}
