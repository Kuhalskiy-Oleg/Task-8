<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotFormRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\ForgotFormMail;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class ForgotController extends Controller
{
    public function forgot_process(ForgotFormRequest $request)
    {

    	$user = User::where('email', $request->validated()['email'])->first();
    	

    	$password = uniqid();

    	
    	$user->password = $password;

    	$user->save();
		
    	
    	Mail::to($user)->send(new ForgotFormMail([
    		'password' => $password,
    		'email'    => $user->email
    	]));

        
        if (Mail::failures()) {

            
            return redirect()->back()->withErrors([
                
                'status_error' => 'The password could not be sent to this email'
            ]);

        
        }else{

            
            return redirect()->back()->withErrors([
                
                'status_succes' => 'The email was sent successfully'
            ]);
        }

    	
    }
}
