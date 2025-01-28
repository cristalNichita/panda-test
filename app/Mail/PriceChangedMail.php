<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PriceChangedMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $adUrl;
    public string $newPrice;

    public function __construct(string $adUrl, string $newPrice)
    {
        $this->adUrl = $adUrl;
        $this->newPrice = $newPrice;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Price Changed Mail',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.price_changed',
            with: [
                'adUrl' => $this->adUrl,
                'newPrice' => $this->newPrice,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
