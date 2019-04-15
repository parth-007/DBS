<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class req_accept extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $purpose,$timestart,$timeend,$user;
    public function __construct($user,$purpose,$timestart,$timeend)
    {
        $this->purpose = $purpose;
        $this->timestart = $timestart;
        $this->timeend = $timeend;
        $this->user = $user;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Request Accepted')->view('client/req_accepted');
    }
}
