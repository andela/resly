<?php

namespace Resly\Http\Controllers;

use Illuminate\Http\Request;
use Resly\Diner;
use Validator;

class DinerProfileController extends Controller
{
    public function show($username)
    {
        $diner = Diner::whereUsername($username)->firstOrFail();

        return view('profile.dinerProfile')->with('diner', $diner);
    }

    public function edit($username)
    {
        $diner = Diner::whereUsername($username)->firstOrFail();

        return view('profile.editDinerProfile')->withDiner($diner);
    }

    public function update(Request $request, $username)
    {
        $diner = Diner::whereUsername($username)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'fname' => 'required|max:20|alpha_dash',
            'lname' => 'required|max:20|alpha_dash',
            'username' => 'required|max:30|alpha_dash',
            'email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('profile.edit', $diner->username)
                ->withErrors($validator);
        }

        $diner->update([
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            ]);

        return redirect()
           ->route('profile.show', $diner->username)
           ->with('info', 'You profile has been updated');
    }
}
