<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservation;

class SecretLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    // Quando creiamo la mail, le passiamo i dati dell'ospite e della casa
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Il tuo Soggiorno a ' . $this->reservation->apartment->name . ' - Link Check-in',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.secret_link', // Questo è il file grafico della mail che creeremo tra poco
        );
    }

    public function attachments(): array
    {
        return [];
    }
}