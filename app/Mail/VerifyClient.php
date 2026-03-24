<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyClient extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $name;
    public $tipo; // 'nuevo' o 'socio'

    /**
     * Create a new message instance.
     *
     * @param string $token
     * @param string $name
     * @return void
     */

    public function __construct($token, $name, $tipo = 'socio')
    {
        $this->token = $token;
        $this->name  = $name;
        $this->tipo  = $tipo;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        $subject = $this->tipo === 'nuevo'
            ? 'Verificación de Cuenta y Membresía'
            : 'Verificación de Membresía';

        return new Envelope(subject: $subject);
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'frontend.emails.verify',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
