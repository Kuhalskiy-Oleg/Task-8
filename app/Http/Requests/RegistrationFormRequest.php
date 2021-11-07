<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationFormRequest extends FormRequest
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
            
            'name'     => 'bail|required|string|max:100|min:2|alpha',
            'surname'  => 'bail|required|string|max:150|min:2|alpha',
            'login'    => 'bail|required|string|max:50|min:5|unique:users|alpha_dash',
            'email'    => 'bail|required|string|email|unique:users,email',
            'password' => 'bail|required|string|max:20|min:3|confirmed',
        ];
    }


    public function messages()
    {
        return [
            'password.confirmed' => 'Ваши пароли не совпадают !',
        ];
    }
}
