<?php

namespace Resly\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Resly\User;

class UserProfileController extends Controller
{
    public function getProfile($fname)
    {
        return view('profile.user');
    }

    public function getEdit()
    {
        $this->authorize('authenticated');

        return view('profile.edit');
    }

    public function postEdit(Request $request)
    {
        $this->validate($requestequest, [
            'fname' => 'alpha|max:50',
            'lname' => 'alpha|max:50',
            'avatar' => 'mimes:jpg,jpeg,png|max:2000',
        ]);

        Auth::users()->update([
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
        ]);

        $filename = $request->input('fname').'-'.$request->input('lname').'-'.Auth::user()->id;

        if ($request->hasFile('avatar')) {
            $this->saveAvatar($filename, $request);
        }

        return redirect()->route('userProfileEdit');
    }

    private function saveAvatar($name, $request)
    {
        //cloudinary public id for the image file
        $public_id = $name;

        //get path to file
        $tmp_avatar_path = $request->file('avatar')->getPathName();

        //upload file to cloudinary
        $result = $this->upload($tmp_avatar_path, $public_id);

        //save avatar in database
        $user = Auth::user();
        $user->avatar = $result['url'];
        $user->save();
    }

    private function upload($filepath, $public_id)
    {
        //set cloudinary config options
        $res = \Cloudinary::config([
          'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
          'api_key'    => env('CLOUDINARY_API_KEY'),
          'api_secret' => env('CLOUDINARY_API_SECRET'),
        ]);

        //upload file
        $upload = \Cloudinary\Uploader::upload(
            $filepath,
            [
                'public_id' => $public_id,
                'crop'      => 'fill',
                'width'     => '350',
                'height'    => '350',
            ]
        );

        //return the uploaded file's meta
        return $upload;
    }
}
