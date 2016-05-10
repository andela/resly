<?php

namespace Resly\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;

class PasswordController extends Controller
{
    public function changePassword(Request $request)
    {
        $oldPassword = $request->input('oldPassword');
        $newPassword = $request->input('newPassword');
        $newPasswordConfirm = $request->input('newPasswordConfirm');
        $result = $this->verifyPassword($oldPassword, $newPassword, $newPasswordConfirm);
        if ($result !== true) {
            $return['error'] = true;
            $return['message'] = $result;
        } else {
            $this->storePassword($newPassword);
            $return['error'] = false;
            $return['message'] = 'Password Updated.';
        }

        return json_encode($return);
    }

    private function storePassword($password)
    {
        Auth::user()->password = Hash::make($password);
        Auth::user()->save();
    }

    private function verifyPassword($old, $newA, $newB)
    {
        $messages = [];
        if (! ($this->isSameWithCurrent($old))) {
            array_push($messages, 'The old password must match the current password.');
        }
        if (! ($this->hasCorrectLength($newA))) {
            array_push($messages, 'Password must be at least 6 characters.');
        }
        if (! ($this->isSameWithNew($newA, $newB))) {
            array_push($messages, 'New password must match confirmation.');
        }
        if (! ($this->isNotSameWithCurrent($newA))) {
            array_push($messages, 'Please choose a password different from the current password.');
        }

        return empty($messages) ? true : $messages;
    }

    private function isSameWithCurrent($old)
    {
        $current = Auth::user()->password;

        return Hash::check($old, $current);
    }

    private function hasCorrectLength($new)
    {
        return strlen($new) >= 6;
    }

    private function isNotSameWithCurrent($new)
    {
        $current = Auth::user()->password;

        return ! (Hash::check($new, $current));
    }

    private function isSameWithNew($newA, $newB)
    {
        return trim($newA) === trim($newB);
    }
}
