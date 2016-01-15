<?php

namespace Resly\Http\Requests;

class GalleryPictureRequest extends Request
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
            'image' => 'required|mimes:jpeg,jpg,gif,png|max:2500',
            'caption' => 'max:140',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'You need to select an image or the image you selected is invalid',
        ];
    }
}
