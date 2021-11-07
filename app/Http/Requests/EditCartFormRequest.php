<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCartFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Если юзер должен быть залогинен(аунтентифицирован) то:
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
            'id'    => 'bail|required|numeric|regex:/^[0-9]*$/|min:0',
            'count' => 'bail|required|numeric|regex:/^[0-9]*$/|max:100|min:0',
        ];
    }


    public function messages()
    {
        return [
            'id.numeric'  => 'передаваемый id товара должен быть числом',
            'id.required' => 'для добавления товара в корзину, должен быть передан id товара',
            'id.regex'    => 'передаваемый id товара должен быть числом без символов',
            'count.numeric'  => 'передаваемое кол-во товара должно быть числом',
            'count.required' => 'для добавления товара в корзину, должено быть передано кол-во товара',
            'count.regex'    => 'передаваемое кол-во товара должно быть числом без символов',
        ];
    }
}
