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
        $event->name = $title;
        if($serviceName == 'Besichtigung')
        {
            $event->startDateTime = Carbon::parse($date)->timezone("Europe/Zurich");
            $event->endDateTime = Carbon::parse($endDate)->addHour(1)->timezone("Europe/Zurich");
        }
        else{
            $event->startDate = Carbon::parse($date)->timezone("Europe/Zurich");
            if($serviceName == 'Reinigung' || 'Reinigung 2'){
                $event->endDate = Carbon::parse($endDate)->addDay(1)->timezone("Europe/Zurich"); // 1 gün ekledik çünkü calendar da 20-23 arası yapınca 20-22 arasını işaretliyor
            }
            else {
                $event->endDate = Carbon::parse($endDate)->timezone("Europe/Zurich");
            }
            
        }
        $event->location = $location;
        $event->description = $comment;
        $event->setColorId(10);
        $event->save();
    }
}
