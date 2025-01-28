<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmSubscriptionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirm Subscription Mail',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.confirm_subscription',
            with: [
                'confirmationUrl' => route('confirmPage', ['token' => $this->token]),
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
