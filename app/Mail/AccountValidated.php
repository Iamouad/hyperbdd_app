<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountValidated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $username;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username)
    {
        //
        $this->username = $username;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.account.account_validated');
    }
}