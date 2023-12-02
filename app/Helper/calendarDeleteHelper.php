<?php

namespace App\Helper;

use App\Models\Calendar;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Log;


class calendarDeleteHelper
{
    static function companyMailDelete($eventId)
    {
        try {
            if ($event = Event::find($eventId)) {
                // Delete Helper Kullan
                $event->delete();
                Calendar::where('eventId', $eventId)->delete();
            } else {
                Log::info('Google Calendar Event not found, might be manually deleted. '.$eventId);
            }
        } catch (\Exception $e) {
            if (strpos($e->getMessage(), 'Not Found') !== false) {
                Calendar::where('eventId', $eventId)->delete();
                Log::info('Google Calendar Event not found might be manually deleted, only Calendar model deleted. (CATCH)'.$eventId);
            } else {
                Log::error('Google Calendar Event Delete Umzug Error: ' . $e->getMessage());
            }
        }
    }
}
