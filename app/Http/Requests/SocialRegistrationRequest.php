<?php

namespace Resly\Http\Requests;

use Resly\Http\Requests\Request;

class SocialRegistrationRequest extends Request
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
            'fname' => 'required',
            'lname' => 'required',
            'role' => 'required|in:diner,restaurateur',
        ];
    }
}
