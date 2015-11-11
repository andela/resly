<?php

namespace Resly\Http\Controllers;

use Illuminate\Http\Request;
use Resly\Diner;
use DB;
use Resly\DinerPhoto;
use Validator;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class DinerProfileController extends Controller
{
    /*
     * Display the diners profile.
     */

    public function show($username)
    {
        $diner = Diner::dinerWithUsername($username);
        $diner->photo = self::getLastInsertedPhoto($diner->id);

        return view('profile.dinerProfile')->with('diner', $diner);
    }

    /*
     * Access the diners edit profile page.
     */

    public function edit($username)
    {
        $diner = Diner::dinerWithUsername($username);

        return view('profile.editDinerProfile')->withDiner($diner);
    }

    /*
     * Update the diners profile.
     */

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
     * Store the Diners profile picture.
     * MakePhoto() makes a new photo and pass the uploaded file instance.
     */

    public function uploadPhoto(Request $request, $username)
    {
        $this->validate($request, [
            'photo' => 'required|mimes:jpg,jpeg,png,bmp',
        ]);

        $photo = $this->makePhoto($request->file('photo'));

        Diner::dinerWithUsername($username)->addPhotos($photo);
    }

    /*
     * Get a new photo object with the given name; 
     * then move it to its permanent location in the file system
     */

    protected function makePhoto(UploadedFile $file)
    {
        return DinerPhoto::named($file->getClientOriginalName())->move($file);
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
