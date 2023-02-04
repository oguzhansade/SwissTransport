<?php
namespace App\Helper;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class calendarHelper
{
    static function companyMail ($appName,$startDateTime,$endDateTime)
    {
        $event = new Event;

        $event->name = $appName;
        $event->startDateTime = Carbon::parse($startDateTime)->timezone("Europe/Berlin");
        $event->endDateTime = Carbon::parse($endDateTime)->addHour()->timezone("Europe/Berlin");
        $event->save();
    }
}
