<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
            'name'    => 'bail|required|string|max:50|min:2|alpha',
            'surname' => 'bail|required|string|max:100|min:2|alpha',
            'email'   => 'bail|required|string|email',
            'text'    => [ 
                            'bail'    ,
                            'required',
                            'string'  ,
                            'max:1500',
                            'min:10'  ,
                            'regex:/^["\'a-zа-яё\d]{1}[-!."\',?a-zа-яё\d\s]*["\'!.?a-zа-яё\d]{1}$/ui'            
                         ],
        ];
    }

    public function messages()
    {
        return [
            'text.regex' => 'Ошибка в синтаксесе ! Используйте толко такие символы: ()\'"-!?,.',
        ];
    }
}
