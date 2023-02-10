<?php
namespace App\Helper;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class calendarHelper
{
    static function companyMail ($serviceName,$date,$name,$surname,$gender,$location,$title,$comment)
    {
        // foreach ($appDates as $items) {
        //     $event = new Event;
        //     $event->name = $items['serviceName'];
        //     $event->startDateTime = $items['date'].$items['time'];
        //     $event->endDateTime = $items['date'].$items['time'];
        //     $event->save();
        // }
        
        $event = new Event;
        // $event->name = ($gender === "male" ? "Herr" : "Frau").' '.$name.' '.$surname.' '.'-'.$serviceName;
        $event->name = $title.' '.'-'.$serviceName;
        $event->startDateTime = Carbon::parse($date)->timezone("Europe/Berlin");
        $event->endDateTime = Carbon::parse($date)->addHour()->timezone("Europe/Berlin");
        $event->location = $location;
        $event->description = $comment;
        $event->save();
    }
}
