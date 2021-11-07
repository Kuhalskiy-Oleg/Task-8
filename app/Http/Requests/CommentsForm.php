<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CommentsForm extends FormRequest
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
            
            
            
            
            
            
            
            
 
            'text' =>   [ 
                            'bail'    ,
                            'required',
                            'string'  ,
                            'max:1500',
                            'min:10'  ,
                            'regex:/^["\'a-zа-яё\d]{1}[-!."\',?a-zа-яё\d\s]*["\'!.?a-zа-яё\d]{1}$/ui'            
                        ],

            'user_id' => 'bail|required|exists:users,id',
        ];
        
        
    }

    
    protected function prepareForValidation()
    {
        
        $this->merge([
            'user_id' => auth()->id()
        ]);
    }


    public function messages()
    {
        return [
            'text.regex' => 'Ошибка в синтаксесе ! Используйте толко такие символы: ()\'"-!?,.',
        ];
    }
}
