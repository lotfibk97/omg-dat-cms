<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
          'name' => 'required|max:30|unique:users',
          'email' => 'required|email|max:255|unique:users',
          'password' => 'required|min:6',
          // 'password3' => 'required|confirmed|min:6',
          // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',

        ];
    }
}
