<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetNewUserPassword extends FormRequest
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
            '_token' => 'required',
            'id' => 'required',
            'username' => 'required|string|max:25',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'confirmed'
        ];
    }
}
