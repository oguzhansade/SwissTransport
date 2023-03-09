<?php
namespace App\Helper;

use App\Models\Calendar;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class calendarEditHelper
{
    static function companyMailEdit ($serviceName,$date,$location,$title,$comment,$endDate,$serviceId)
    {
        
        $event = new Event;
        $event->name = $title;
        $appType = NULL;
        if($serviceName == 'Lieferung')
        {
            $appType = 3;
            $event->startDateTime = Carbon::parse($date)->timezone("Europe/Zurich");
            $event->endDateTime = Carbon::parse($endDate)->addHour(1)->timezone("Europe/Zurich");
        }
        else{
            if($serviceName == 'Besichtigung')
            {
                $appType = 1;
                $event->startDateTime = Carbon::parse($date)->timezone("Europe/Zurich");
                $event->endDateTime = Carbon::parse($endDate)->addHour(1)->timezone("Europe/Zurich");
            }
            else{
                $appType = 2;
                $event->startDate = Carbon::parse($date)->timezone("Europe/Zurich");
                if($serviceName == 'Reinigung' || 'Reinigung 2'){
                    $event->endDate = Carbon::parse($endDate)->addDay(1)->timezone("Europe/Zurich"); // 1 gün ekledik çünkü calendar da 20-23 arası yapınca 20-22 arasını işaretliyor
                }
                else {
                    $event->endDate = Carbon::parse($endDate)->timezone("Europe/Zurich");
                }
                
            }
        }
       
        
        $event->location = $location;
        $event->description = $comment;
        $event->setColorId(10);
        $etkinlik = $event->save();
        $eventId = $etkinlik->id;
        
        $eventInfo = 
        [
            'appType' => $appType,
            'serviceType' => $serviceName,
            'serviceId' => $serviceId,
            'eventId' => $eventId,
        ];
        Calendar::create($eventInfo);
       
        
        
    }
}
