<?php

namespace Resly\Http\Requests;

use Resly\Http\Requests\Request;

class RegisterTraditionallyRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fname' => 'required|max:20|alpha_dash',
            'lname' => 'required|max:20|alpha_dash',
            'username' => 'required|unique:users|max:30|alpha_dash',
            'email' => 'required|unique:users|email|max:255',
            'password' => 'required|min:6',
            'confirm-password' => 'required|same:password',
            'role' => 'required|in:diner,restaurateur',
        ];
    }
}
