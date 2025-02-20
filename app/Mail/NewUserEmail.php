<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewUserEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $messageBody;
    protected $email;
    protected $password;
    protected $url; 

    /**
     * Create a new message instance.
     */
    public function __construct(
        string $message,
        string $email,
        string $password,
    )
    {
        $this->messageBody = $message;
        $this->email = $email;
        $this->password = $password;
        $this->url = route('profile.show');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New User Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.newUser',
            with: [
                'messageBody' => $this->messageBody,
                'email' => $this->email,
                'password' => $this->password,
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
