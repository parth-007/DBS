<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class deny_mail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $purpose,$timestart,$timeend,$resource,$user;
    public function __construct($purpose,$timestart,$timeend,$resource,$user)
    {
        $this->purpose = $purpose;
        $this->timestart = $timestart;
        $this->timeend = $timeend;
        $this->resource = $resource;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Request Denied')->view('client/req_denied');
    }
}
