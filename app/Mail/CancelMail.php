<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CancelMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $faculty,$purpose,$timestart,$timeend,$fac_purpose;
    public function __construct($faculty,$purpose,$timestart,$timeend,$fac_purpose)
    {
        $this->faculty = $faculty;
        $this->purpose = $purpose;
        $this->timestart = $timestart;
        $this->timeend = $timeend;
        $this->fac_purpose = $fac_purpose;   
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('client/cancel_mail');
    }
}
