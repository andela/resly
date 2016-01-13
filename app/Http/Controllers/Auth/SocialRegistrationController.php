<?php

namespace Resly\Http\Controllers\Auth;

use Auth;
use Mail;
use Resly\User;
use Resly\Http\Requests;
use Illuminate\Http\Request;
use Resly\Http\Controllers\Controller;

class SocialRegistrationController extends Controller
{
    /**
     * display the user registration form
     * for those that wish to register using
     * social registration.
     *
     * @return view social.register
     */
    public function getRegistration()
    {
        return view('social.register');
    }

    /**
     * store registration data in preparation for registration
     * after social authentication.
     *
     * @param  Requests\SocialRegistrationRequest request
     *
     * @return redirect to social provider
     */
    public function postRegistration(Requests\SocialRegistrationRequest $request)
    {
        $user = new User();
        $user->username = session()->get('username');
        $user->email = session()->get('email');
        $user->avatar_url = session()->get('avatar_url');
        $user->provider_name = session()->get('provider_name');
        $user->provider_id = session()->get('provider_id');

        $user->role = $request->input('role');
        $user->fname = $request->input('fname');
        $user->lname = $request->input('lname');

        $user->save();

        Mail::send('email.welcome', ['user' => $user], function ($message) use ($user) {
            $message->from('reslytesting@gmail.com', 'Resly, a new way to dine');

            $message->to($user->email, $user->name)->subject('Welcome to Resly!');
        });

        session()->forget('name');
        session()->forget('email');
        session()->forget('avatar');
        session()->forget('provider_name');
        session()->forget('provider_id');

        Auth::login($user);

        return redirect('/');
    }
}
