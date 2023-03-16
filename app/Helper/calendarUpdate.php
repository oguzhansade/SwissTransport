<?php

namespace App\Helper;

use App\Models\Calendar;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class calendarUpdate
{
    static function calendarUpdate($serviceName, $date, $location, $title, $comment, $endDate, $serviceId, $eventId)
    {

        if($eventId){
            
            $event = Event::find($eventId);
            $event->delete($eventId);
            calendarHelper::companyMail($serviceName,$date,$location,$title,$comment,$endDate,$serviceId);
        }
        else {
            calendarHelper::companyMail($serviceName,$date,$location,$title,$comment,$endDate,$serviceId);
        }
        
    }
}
