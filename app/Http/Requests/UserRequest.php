<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
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
        $user = Auth::user();
        return [
            'first_name' => 'sometimes|string|min:3|max:50',
            'last_name' => 'sometimes|string|min:3|max:50',
            'login' => 'sometimes|string|min:3|max:50',
            'email' => 'unique:users,email,' . $user->id,
            'birthday' => 'nullable|date_format:Y-m-d|before:today',
            'role' => 'numeric|unique:roles,id,' . $user->id,
            'password' => 'nullable|confirmed|min:8',
        ];
    }
}
