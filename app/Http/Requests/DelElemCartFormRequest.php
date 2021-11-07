<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DelElemCartFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        
        return auth()->check();
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'bail|required|numeric|regex:/^[0-9]*$/'
        ];
    }


    public function messages()
    {
        return [
            'id.numeric'  => 'передаваемый id товара должен быть числом',
            'id.required' => 'для удаления товара из корзины должен быть передан id товара',
            'id.regex'    => 'передаваемый id товара должен быть числом без символов',
        ];
    }
}
