<?php

namespace App\Http\Requests;

use App\Common\CheckPermission;
use App\Common\Permission\Permissions;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|max:255',
            'fullname' => 'required',
            'job_title' => 'required',
            
        ];
    }
}
