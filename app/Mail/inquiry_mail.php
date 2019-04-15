<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class inquiry_mail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *

     * @return void
     */

    public $msg;
    public $que;
    public function __construct($que,$msg)
    {
        $this->msg=$msg;
        $this->que=$que;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Message From DBS')->view('admin/content_mail');
    }
}
