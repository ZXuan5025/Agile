<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendAnnouncement extends Mailable {
    use Queueable, SerializesModels;

    public $message;

    public function __construct($message) {
        $this->message = $message;
    }

    // public function build() {
    //     return $this->subject($this->subject)
    //                 ->markdown('emails.ann-removed')
    //                 ->with('message', $this->message);
    // }

    public function build()
    {
        return $this->subject('Announcement from Smart EDU')
            ->view('emails.announcement')
            ->with('message', $this->message);
    }

}