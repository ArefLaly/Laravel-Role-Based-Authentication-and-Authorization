<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|unique:users|max:255',
            'fullname' => 'required',
            'job_title' => 'required',
            'password' => 'required',
            'photo' => 'required',
        ];
    }
}
