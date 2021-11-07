<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contactForm(ContactFormRequest $request)
    {
    	Mail::to('Kuhalskiy96@yandex.ru')->send(new ContactFormMail($request->validated()));
       
        if (Mail::failures()) {
            
            return redirect()->back()->withErrors([
                
                'status_error' => 'Contact form not send'
            ]);
       
        }else{
          
            return redirect()->back()->withErrors([
                
                'status_succes' => 'Contact form succes send'
            ]);
        }
	
    }
}
