<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegistrationFormRequest;


class RegistrationController extends Controller
{

    public function registrationUser(RegistrationFormRequest $request)
    {
    	

		if (Auth::check()) {
			
			return redirect(route('kabinet'));
		}


        $validateData = $request->validated();
        
        
        
        $user = User::create($validateData);




    	
    	if ($user) {
    		
    		
    		
    		Auth::login($user);

    		
    		
    		return redirect(route('kabinet'));

    	}else{

            
            return redirect(route('auth.registration'))->withErrors([
                'formError' => 'Произошла ошибка при сохранении пользователя'
            ]);

        }


    	


    }
}
