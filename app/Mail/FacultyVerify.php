<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FacultyVerify extends Mailable
{
    use Queueable, SerializesModels;
    public $link,$pass;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($link,$pass)
    {
        $this->pass = $pass;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Find the Credentials')->view('admin/faculty_verify');
    }
}
