<?php
namespace App\Helper;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class calendarHelper
{
    static function companyMail ($serviceName,$date,$name,$surname,$gender,$location,$title,$comment,$endDate)
    {
        $event = new Event;
        $event->name = $serviceName.'/'.' '.$title;
        $event->startDateTime = Carbon::parse($date)->timezone("Europe/Zurich");
        $event->endDateTime = Carbon::parse($endDate)->timezone("Europe/Zurich");
        $event->location = $location;
        $event->description = $comment;
        $event->save();
    }
}
