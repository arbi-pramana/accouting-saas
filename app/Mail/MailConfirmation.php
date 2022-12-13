<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $name;
    protected $email;
    protected $token;
    public function __construct($name,$email,$token)
    {
        $this->name = $name;
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
        $data['name'] = $this->name;
        $data['email'] = $this->email;
        $data['token'] = $this->token;
        return $this->subject('Finsa Email Confirmation')
            ->view('users.mail.confirmation-mail',$data);
    }
}
