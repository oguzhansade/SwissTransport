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
            $event = Event::find($eventId);
            if ($serviceName == 'Lieferung') {
                $event->update(
                    [
                        'name' => $title,
                        'location' => $location,
                        'description' => $comment,
                        'startDateTime' => Carbon::parse($date)->timezone("Europe/Zurich"),
                        'endDateTime' => Carbon::parse($endDate)->addHour(1)->timezone("Europe/Zurich"),
                        'colorId' => '10',
                    ]
                );
                $event->startDateTime = Carbon::parse($date)->timezone("Europe/Zurich");
                $event->endDateTime = Carbon::parse($endDate)->addHour(1)->timezone("Europe/Zurich");
            } else {
                if ($serviceName == 'Besichtigung') {
                    $event->update(
                        [
                            'name' => $title,
                            'location' => $location,
                            'description' => $comment,
                            'startDateTime' => Carbon::parse($date)->timezone("Europe/Zurich"),
                            'endDateTime' => Carbon::parse($endDate)->addHour(1)->timezone("Europe/Zurich"),
                            'colorId' => '10',
                        ]
                    );
                }
                else {
                    if ($serviceName == 'Reinigung' || 'Reinigung 2') {
                        $event->update(
                            [
                                'name' => $title,
                                'location' => $location,
                                'description' => $comment,
                                'startDate' => Carbon::parse($date)->timezone("Europe/Zurich"),
                                'endDate' => Carbon::parse($endDate)->addDay(1)->timezone("Europe/Zurich"),
                                'colorId' => '10',
                            ]
                        );
                    }
                    else {
                        $event->update(
                            [
                                'name' => $title,
                                'location' => $location,
                                'description' => $comment,
                                'startDate' => Carbon::parse($date)->timezone("Europe/Zurich"),
                                'endDate' => Carbon::parse($endDate)->timezone("Europe/Zurich"),
                                'colorId' => '10',
                            ]
                        );
                    }
                }

            }
        } else {
            $colorId = '10';
            calendarHelper::companyMail($serviceName, $date, $location, $title, $comment, $endDate, $serviceId,$colorId);
        }
    }
        
    }

