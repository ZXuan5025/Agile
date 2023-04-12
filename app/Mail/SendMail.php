<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $testMailData;
    /**
     * Create a new message instance.
     */
    public function __construct($testMailData)
    {
        $this->testMailData = $testMailData;
    }

    public function build()
    {
        return $this->subject('Email From Student EDU')
                    ->view('student.registerformat');
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Send Mail',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    // // /**
    // //  * Get the attachments for the message.
    // //  *
    // //  * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    // //  */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
