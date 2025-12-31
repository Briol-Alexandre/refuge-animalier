<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserCreation extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public User $data)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address("noreply@lespattesheureuses.be", 'Les Pattes Heureuses'),
            subject: 'Création de votre compte',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.user_created',
            with: ['data' => $this->data]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
