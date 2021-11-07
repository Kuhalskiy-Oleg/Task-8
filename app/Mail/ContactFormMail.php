<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    
    protected $formData = [];
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($validatedDataFromContactForm)
    {
        
        
        $this->formData = $validatedDataFromContactForm;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        
        
        return $this->view('emails.contactForm')->with($this->formData);

        
        
        
        
    }
}
