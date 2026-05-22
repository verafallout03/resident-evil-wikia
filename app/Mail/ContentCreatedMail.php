<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContentCreatedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $type,
        public string $name,
        public string $createdBy,
    ) {}

    public function envelope(): Envelope
    {
        $labels = [
            'character' => 'Personaje',
            'game'      => 'Juego',
            'location'  => 'Locación',
        ];

        return new Envelope(
            subject: 'Nuevo ' . ($labels[$this->type] ?? $this->type) . ' creado — Resident Evil Wikia',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.content-created',
        );
    }
}
