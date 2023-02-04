<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Spatie\IcalendarGenerator\Components\Calendar;
use Spatie\IcalendarGenerator\Components\Event;
use Spatie\IcalendarGenerator\Properties\TextProperty;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

use Illuminate\Notifications\Messages\MailMessage;
use Spatie\CalendarLinks\Link;
use App\Helper\calendarHelper;
use Spatie\IcalendarGenerator\Enums\ParticipationStatus;
use Illuminate\Support\Facades\Mail;

class CompanyMail extends Mailable
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
        $calendar = Calendar::create()
        ->productIdentifier('CAMDALIO COMPANY')
        ->event(function (Event $event) {
            $event->name("Email with iCal 101")
                ->attendee("attendee@gmail.com")
                ->startsAt(Carbon::parse("2022-12-15 08:00:00"))
                ->endsAt(Carbon::parse("2022-12-19 17:00:00"))
                ->fullDay()
                ->address('Online - Google Meet');
        });
        $calendar->appendProperty(TextProperty::create('METHOD', 'REQUEST'));

            return $this->view('cemail')
                    ->subject($this->data['sub'])
                    ->from($this->data['from'],$this->data['companyName'])
                    ->html($this->data['customEmailContent'])
                    ->with('data',$this->data)
                    ->attachData($calendar->get(), 'invite.ics', [
                        'mime' => 'text/calendar; charset=UTF-8; method=REQUEST',
                    ]);
        }
        else 
        {
            
            $fullDate = $this->data['appDate'][0]['date'].' '.$this->data['appDate'][0]['time'];
            $companyCalendar = calendarHelper::companyMail(
                $this->data['sub'],
                $fullDate,
                $fullDate
            );

        return $this->view('tempEmail')
                ->subject($this->data['email'].' '.'Sistem Randevu Bildirimi')
                ->from($this->data['from'],$this->data['companyName'])                   
                ->with('data',$this->data);
                
                   
        }
    }
}
