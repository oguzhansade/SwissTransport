<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OfferMail extends Mailable
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
        if($this->data['isCustomEmailSend'])
        {
            if($this->data['isReinigungPdf'] == 'send'){
                return $this->view('offerEmail')
                ->subject($this->data['sub'])
                ->from($this->data['from'],$this->data['companyName'])
                ->html($this->data['customEmailContent'].$this->data['customLinks'].$this->data['offerMailFooter'])
                ->with('data',$this->data)
                ->attachData($this->data['pdf']->output(), 'offerte-'.$this->data['offerteNumber'].'.pdf')
                ->attach(asset('assets/demo/AGB.pdf'))
                ->attach(asset('assets/demo/Leistungsübersicht-Reinigung.pdf'));
            }
            else {
                return $this->view('offerEmail')
                ->subject($this->data['sub'])
                ->from($this->data['from'],$this->data['companyName'])
                ->html($this->data['customEmailContent'].$this->data['customLinks'].$this->data['offerMailFooter'])
                ->with('data',$this->data)
                ->attachData($this->data['pdf']->output(), 'offerte-'.$this->data['offerteNumber'].'.pdf')
                ->attach(asset('assets/demo/AGB.pdf'));
            }
        }
        else
        {
           
            if($this->data['isReinigungPdf'] == 'send'){
                return $this->view('offerEmail')
                ->subject($this->data['sub'])
                ->from($this->data['from'],$this->data['companyName'])
                ->with('data',$this->data)
                ->attachData($this->data['pdf']->output(), 'offerte-'.$this->data['offerteNumber'].'.pdf')
                ->attach(asset('assets/demo/AGB.pdf'))
                ->attach(asset('assets/demo/Leistungsübersicht-Reinigung.pdf'));
            }
            else{
                return $this->view('offerEmail')
                ->subject($this->data['sub'])
                ->from($this->data['from'],$this->data['companyName'])
                ->with('data',$this->data)
                ->attachData($this->data['pdf']->output(), 'offerte-'.$this->data['offerteNumber'].'.pdf')
                ->attach(asset('assets/demo/AGB.pdf'));
            }
            
        }
        return $this->view('view.name');
    }
}
