<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BaseUploaded extends Mailable implements ShouldQueue
{
    public $username;
    public $idBase;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, $idBase)
    {      //
        $this->username = $username;
        $this->idBase = $idBase;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.base.base_uploaded');
    }
}