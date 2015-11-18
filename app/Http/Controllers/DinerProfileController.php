<?php

namespace Resly\Http\Controllers;

use Illuminate\Http\Request;
use Resly\Diner;
use Resly\Booking;
use DB;
use Resly\DinerPhoto;
use Validator;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use DateTime;

class DinerProfileController extends Controller
{
    /*
     * Display the diners profile.
     *
     * Also, categorize reservations as either past or future reservations
     * and send the data to the profile view.
     */

    public function show($username)
    {
        $diner = Diner::dinerWithUsername($username);
        $diner->photo = self::getLastInsertedPhoto($diner->id);
        $diner->cancellations = Booking::onlyTrashed()
            ->where('diner_id', $diner->id)
            ->get();
        $diner->reservations = Booking::where('diner_id', $diner->id)->get();

        $reserveFuture = [];
        $reservePast = [];

        foreach ($diner->reservations as $reservation) {
            date_default_timezone_set('Africa/Nairobi');

            $dateDatabase = $reservation->booking_date.$reservation->booking_time;
            $date1 = new DateTime($dateDatabase);

            $date2 = new DateTime('now');

            if ($date1 < $date2) {
                array_push($reservePast, $reservation);
            } else {
                array_push($reserveFuture, $reservation);
            }
        }

        return view('profile.dinerProfile')
            ->with(compact('diner', 'reservePast', 'reserveFuture'));
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
