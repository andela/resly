<?php

namespace Resly\Http\Controllers;

use Illuminate\Http\Request;
use Resly\Diner;
use DB;
use Resly\DinerPhoto;
use Validator;

class DinerProfileController extends Controller
{
    public function show($username)
    {
        $diner = Diner::dinerWithUsername($username);
        $diner->photo = self::getLastInsertedPhoto($diner->id);

        return view('profile.dinerProfile')->with('diner', $diner);
    }

    public function edit($username)
    {
        $diner = Diner::dinerWithUsername($username);

        return view('profile.editDinerProfile')->withDiner($diner);
    }

    public function update(Request $request, $username)
    {
        $diner = Diner::dinerWithUsername($username);

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
    
    /*
     * store the Diners profile picture
     */
    public function uploadPhoto(Request $request, $username)
    {
        $this->validate($request, [
            'photo' => 'required|mimes:jpg,jpeg,png,bmp'
        ]);

        $photo = DinerPhoto::uploadedPicture($request->file('photo'));

        Diner::dinerWithUsername($username)->addPhotos($photo);
    }

    /*
     * Retrieve the last uploaded profile picture
     */
    private static function getLastInsertedPhoto($user_id)
    {
        $picture = DB::table('diner_photo')
            ->where('diner_id', $user_id)
            ->orderBy('id', 'desc')
            ->first();
        return $picture;
    }
}
