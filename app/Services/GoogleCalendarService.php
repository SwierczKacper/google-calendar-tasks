<?php

namespace App\Services;

use DateTime;
use Google\Service\Calendar\Event;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use Google_Service_Calendar_Events;
use Illuminate\Support\Carbon;

class GoogleCalendarService
{
    public function __construct(
        private Google_Service_Calendar $googleCalendarService,
    ) {
        $this->googleCalendarService = new Google_Service_Calendar($this->createClient());
    }

    public function createClient(): Google_Client
    {
        $client = new Google_Client();

        $client->setScopes([
            Google_Service_Calendar::CALENDAR,
        ]);

        $client->setAuthConfig(config('google-calendar.service_account_json'));

        return $client;
    }

    public function listEvents(Carbon $startDateTime = null, Carbon $endDateTime = null, array $queryParameters = []): Google_Service_Calendar_Events
    {
        $parameters = [
            'singleEvents' => true,
            'orderBy' => 'startTime',
        ];

        if (is_null($startDateTime)) {
            $startDateTime = Carbon::now()->startOfDay();
        }

        $parameters['timeMin'] = $startDateTime->format(DateTime::RFC3339);

        if (is_null($endDateTime)) {
            $endDateTime = Carbon::now()->addYear()->endOfDay();
        }
        $parameters['timeMax'] = $endDateTime->format(DateTime::RFC3339);

        $parameters = array_merge($parameters, $queryParameters);

        return $this
            ->googleCalendarService
            ->events
            ->listEvents(config('google-calendar.calendar_id'), $parameters);
    }

    public function createWeeklyEvent(string $name, int $colorId, Carbon $startDate, Carbon $endDate)
    {
        $event = new Google_Service_Calendar_Event();
        $event->setSummary($name);
        $start = new Google_Service_Calendar_EventDateTime();
        $start->setDateTime($startDate->format(DateTime::RFC3339));
        $start->setTimeZone('Europe/Warsaw');
        $event->setStart($start);
        $end = new Google_Service_Calendar_EventDateTime();
        $end->setDateTime($endDate->format(DateTime::RFC3339));
        $end->setTimeZone('Europe/Warsaw');
        $event->setEnd($end);
        $event->setRecurrence(['RRULE:FREQ=WEEKLY;WKST=TU']);
        $event->setColorId($colorId);

        return $this->googleCalendarService->events->insert(config('google-calendar.calendar_id'), $event);
    }

    public function getEvent(string $eventId): Google_Service_Calendar_Event
    {
        return $this->googleCalendarService->events->get(config('google-calendar.calendar_id'), $eventId);
    }

    public function updateEvent(Event $event, $optParams = []): Google_Service_Calendar_Event
    {
        return $this->googleCalendarService->events->update(config('google-calendar.calendar_id'), $event->id, $event, $optParams);
    }

    public function insertEvent(Event $event, $optParams = []): Google_Service_Calendar_Event
    {
        return $this->googleCalendarService->events->insert(config('google-calendar.calendar_id'), $event, $optParams);
    }

    public function deleteEvent(string $eventId, $optParams = [])
    {
        $this->googleCalendarService->events->delete(config('google-calendar.calendar_id'), $eventId, $optParams);
    }

    public function deleteRecurringEvent(string $eventId, Carbon $date, $optParams = [])
    {
        $event = $this->getEvent($eventId);
        $event->setRecurrence(['RRULE:FREQ=WEEKLY;UNTIL=' . $date->format('Ymd\THis\Z')]);
        $event = $this->updateEvent($event);

        if (Carbon::parse($event->start->dateTime ?? $event->start->date)->format('d.m.Y') == $date->format('d.m.Y')) {
            $this->deleteEvent($eventId);
        }
    }
}
