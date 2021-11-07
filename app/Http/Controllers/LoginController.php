<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function loginProcess(Request $request)
    {


    	$validateData = $request->validate([
    		
    		
    		
    		
    		'login'    => 'bail|required|string|max:50|min:5|alpha_dash',
    		'password' => 'bail|required|string|max:255|min:3',
    	]);


    	if (Auth::attempt($validateData)) {
    		
    		return redirect()->intended(route('kabinet'));
    	}

    	
    	return redirect(route('auth.login'))->withErrors([
    		'error' => 'Такого пользователя не существует'
    	]);
    }

}
