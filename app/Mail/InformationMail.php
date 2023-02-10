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
             
            $calendar =  Calendar::create($this->data['companyName'])
            ->event(Event::create($this->data['sub'])                   
                ->organizer($this->data['from'],$this->data['companyName'])
                ->attendee($this->data['email'])  
                ->startsAt(new DateTime($this->data['appDate'][0]['date'].' '.$this->data['appDate'][0]['time'], new DateTimeZone('Europe/Istanbul')))
                ->endsAt(new DateTime($this->data['appDate'][0]['date']))
                
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
            
            // $eventArray = [];
            // $eventArray = 
            //     Event::create($p['serviceName'])                   
            //     ->startsAt(new DateTime($p['date'].' '.$p['time'], new DateTimeZone('Europe/Istanbul')))
            //     ->endsAt(new DateTime($p['date']));
            // }
            // $appDateArray[$ADC]['date'] = $appointmentMaterial['meetingDate'];
              
            //     $eventArray[$ADC]['event'] = Event::create($p['serviceName']);
            // }
            // $calendar = Calendar::create('Laracon Online')
            // ->event(
            //     [
            //         Event::create($this->data['appDate']['date'])
            //     ]
            // );
            //     $event = Event::create($p['serviceName']);
            // Calendar::create('Laracon Online')
            // ->event([
            //     foreach ($this->data['appDate'] as $p) {
            //         Event::create('Creating contact lists')
            //     }
            // ])
                
                    // $calendar =  Calendar::create($this->data['companyName'])
                    // ->event(
                    //    [
                    //     Event::create($p['serviceName'])                   
                    //     ->startsAt(new DateTime($p['date'].' '.$p['time'], new DateTimeZone('Europe/Istanbul')))
                    //     ->endsAt(new DateTime($p['date']))
                    //    ]
                    // );
               
                
                
            
            

        return $this->view('email')
                ->subject($this->data['sub'])
                ->from($this->data['from'],$this->data['companyName'])                   
                ->with('data',$this->data);
                // ->attachData($calendar->get(), 'invite.ics', [
                //     'mime' => 'text/calendar; charset=UTF-8; ',
                // ]);
        }
    }
}
