<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LagerungMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('lagerungMail')
                    ->subject($this->data['sub'])
                    ->from($this->data['from'],$this->data['companyName'])
                    ->with('data',$this->data)
                    ->attachData($this->data['pdf']->output(), 'Lagerung Rechnung-'.$this->data['invoiceNumber'].'.pdf');
    }
}
