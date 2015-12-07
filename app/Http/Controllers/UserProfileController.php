<?php

namespace Resly\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Resly\User;

class UserProfileController extends Controller
{
    public function getProfile($username)
    {
        return view('profile.user');
    }

    public function getEdit()
    {
        return view('profile.edit');
    }

    public function postEdit(Request $request)
    {
        $this->validate($request, [
            'username' => 'alpha|max:50',
            'fname' => 'alpha|max:50',
            'lname' => 'alpha|max:50',
        ]);

        Auth::user()->update([
            'username' => $request->input('username'),
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
        ]);

        return redirect()->route('userProfileEdit');
    }
}
