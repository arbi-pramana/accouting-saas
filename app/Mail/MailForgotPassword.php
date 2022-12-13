<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;
    protected $token;
    public function __construct($email,$token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data['email'] = $this->email;
        $data['token'] = $this->token;
        return $this->subject('Finsa Forgot Password')
            ->view('users.mail.forgot-password',$data);
    }
}
