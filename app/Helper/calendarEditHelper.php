<?php

namespace App\Helper;

use App\Models\Calendar;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Log;

class calendarEditHelper
{
    static function companyMailEdit($serviceName, $date, $location, $title, $comment, $endDate, $serviceId, $eventId)
    {

        if ($eventId) {
            try{
                $event = Event::find($eventId);
                $eventData = [
                    'name' => $title,
                    'location' => $location,
                    'description' => $comment,
                    'colorId' => '10',
                ];
            
                switch ($serviceName) {
                    case 'Lieferung':
                        $eventData['startDateTime'] = $eventData['endDateTime'] = Carbon::parse($date)->timezone("Europe/Zurich");
                        $eventData['endDateTime']->addHour(1);
                        break;
            
                    case 'Besichtigung':
                        $eventData['startDateTime'] = Carbon::parse($date)->timezone("Europe/Zurich");
                        $eventData['endDateTime'] = Carbon::parse($endDate)->addHour(1)->timezone("Europe/Zurich");
                        break;
            
                    case 'Reinigung':
                    case 'Reinigung 2':
                        $eventData['startDateTime'] = Carbon::parse($date)->timezone("Europe/Zurich");
                        $eventData['endDateTime'] = Carbon::parse($endDate)->addDay(1)->timezone("Europe/Zurich");
                        break;
            
                    default:
                        $eventData['startDateTime'] = Carbon::parse($date)->timezone("Europe/Zurich");
                        $eventData['endDateTime'] = Carbon::parse($endDate)->timezone("Europe/Zurich");
                        break;
                }
            
                $event->update($eventData);
            }
            catch (\Exception $e) {
                if (strpos($e->getMessage(), 'Not Found') !== false) {
                    Log::info('Google Calendar Event not found might be manually deleted, only Calendar model deleted. (CATCH)');
                } else {
                    Log::error('Google Calendar Event Delete Error: ' . $e->getMessage());
                }
            }
        } else {
            $colorId = '10';
            calendarHelper::companyMail($serviceName, $date, $location, $title, $comment, $endDate, $serviceId, $colorId);
        }
        
    }
}
