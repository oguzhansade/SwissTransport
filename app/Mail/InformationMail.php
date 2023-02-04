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

class InformationMail extends Mailable
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
             
            $calendar =  Calendar::create('Camdalio Company')
            ->event(Event::create($this->data['sub'])                   
                ->organizer($this->data['from'],$this->data['companyName'])
                ->attendee($this->data['email'])  
                ->startsAt(new DateTime($this->data['appDate'][0]['date'].' '.$this->data['appDate'][0]['time'], new DateTimeZone('Europe/Istanbul')))
                ->endsAt(new DateTime($this->data['appDate'][0]['date']))
                
            );

            $fullDate = $this->data['appDate'][0]['date'].' '.$this->data['appDate'][0]['time'];
            $companyCalendar = calendarHelper::companyMail(
                $this->data['sub'],
                $fullDate,
                $fullDate
            );

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
   
            $calendar =  Calendar::create('Camdalio Company')
            ->event(Event::create($this->data['sub'])                   
                ->organizer($this->data['from'],$this->data['companyName'])
                ->attendee($this->data['email'])  
                ->startsAt(new DateTime($this->data['appDate'][0]['date'].' '.$this->data['appDate'][0]['time'], new DateTimeZone('Europe/Istanbul')))
                ->endsAt(new DateTime($this->data['appDate'][0]['date'].' '.$this->data['appDate'][0]['time'], new DateTimeZone('Europe/Istanbul')))
                
            );

            $fullDate = $this->data['appDate'][0]['date'].' '.$this->data['appDate'][0]['time'];
            $companyCalendar = calendarHelper::companyMail(
                $this->data['sub'],
                $fullDate,
                $fullDate
            );

        return $this->view('email')
                ->subject($this->data['sub'])
                ->from($this->data['from'],$this->data['companyName'])                   
                ->with('data',$this->data)
                ->attachData($calendar->get(), 'invite.ics', [
                    'mime' => 'text/calendar; charset=UTF-8; method=oguzhansade1@gmail.com',
                ]);
        }
    }
}
