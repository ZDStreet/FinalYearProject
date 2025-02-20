<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AssignEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $messageBody;
    protected $url; 

    /**
     * Create a new message instance.
     */
    public function __construct(
        string $message, 
        string $abstractId = null,
    )
    {
        $this->messageBody = $message;
        $this->url = route('abstracts.show', ['abstract' => $abstractId]);
        
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Assigned Abstract',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.assign',
            with: [
                'messageBody' => $this->messageBody,
                'url' => $this->url,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
