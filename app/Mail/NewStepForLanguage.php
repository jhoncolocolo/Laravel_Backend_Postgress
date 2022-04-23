<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewStepForLanguage extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "A new step was create in The app"; //Subject of email

    /*Propierties Any property in this class can be accessed from the mail view any property in this class can be accessed from the mail view*/
    public $info = "";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($info)
    {
        $this->info = $info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.new_step');  //To define the view of our content of mail
    }
}
