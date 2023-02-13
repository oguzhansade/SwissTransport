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
        foreach ($this->data['appDate'] as $item) {
            $fullDate = $item['date'].' '.$item['time'];
            $endDate = $item['endDate'].' '.$item['endTime'];
            $location = $item['calendarLocation'];
            $title = $item['calendarTitle'];
            $comment =  $item['calendarComment'];
            calendarHelper::companyMail($item['serviceName'],$fullDate,$this->data['name'],$this->data['surname'],$this->data['gender'],$location,$title,$comment,$endDate);
        }
            
        return $this->view('tempEmail')
                ->subject($this->data['email'].' '.'System Termine Notice')
                ->from($this->data['from'],$this->data['companyName'])                   
                ->with('data',$this->data);
    }
}
