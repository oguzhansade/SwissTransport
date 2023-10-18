<?php

namespace App\Mail;

use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ErrorMail extends Mailable
{
    use Queueable, SerializesModels;

    public $error;

    public function __construct($error)
    {
        $this->error = $error;
    }

    public function build()
    {
        return $this->view('mail.error')
            ->subject('SWISSTRANSPORT-CRM: Hata Bildirimi') // E-posta başlığını burada ayarlayabilirsiniz.
            ->from('swisstransportcrm@example.com', 'SWISSTRANSPORT-CRM HATA BİLDİRİMİ');
    }
}
