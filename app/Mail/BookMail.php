<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $purpose,$timestart,$timeend,$resource;
    public function __construct($purpose,$timestart,$timeend,$resource)
    {
        $this->purpose = $purpose;
        $this->timestart = $timestart;
        $this->timeend = $timeend;
        $this->resource = $resource;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('client/succ_mail');
    }
}
