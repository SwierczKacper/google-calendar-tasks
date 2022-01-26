<?php

namespace App\Http\Livewire;

use App\Services\GoogleCalendarService;
use Google\Service\Calendar\Event;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Livewire\Component;

class EventsList extends Component
{
    public string $today;

    public string $tomorrow;

    public bool $displayMarked = false;

    public function updatedDisplayMarked()
    {
        $this->cacheClear();
    }

    public function mount()
    {
        $this->today = Carbon::today()->format('d.m.Y'); //first day for events
        $this->tomorrow = Carbon::tomorrow()->format('d.m.Y'); //last day for events
    }

    /**
     * Check if event isn`t already marked as done or skipped.
     */
    public function determineIfEventClear(string $eventName): bool
    {
        return !Str::contains($eventName, __('calendar.done_suffix')) && !Str::contains($eventName, __('calendar.skipped_suffix'));
    }

    /**
     * Return event left time to end date in seconds.
     */
    public function getEventLeftSeconds($event): int
    {
        if (Carbon::now() > Carbon::parse($event->start->dateTime ?? $event->start->date) && Carbon::now() < Carbon::parse($event->end->dateTime ?? $event->end->date)) {
            return Carbon::parse($event->end->dateTime ?? $event->end->date)->diffInSeconds(Carbon::now());
        }

        return 0;
    }

    /**
     * Return hex color for event.
     */
    public function getEventColor(int $colorId = null): string
    {
        if (config('google-calendar.colors') && Arr::has(config('google-calendar.colors'), $colorId)) {
            $color = config('google-calendar.colors')[$colorId];
        }

        return $color ?? '#000';
    }

    /**
     * Mark event as done or skipped by changing it`s name.
     */
    public function markEventAs(string $eventId, string $action): void
    {
        $event = resolve(GoogleCalendarService::class)->getEvent($eventId); //find google calendar event by id

        if ($this->determineIfEventClear($event->getSummary())) { //check if name can be changed
            $event->setSummary($event->getSummary() . __('calendar.' . $action . '_suffix')); //change name

            resolve(GoogleCalendarService::class)->updateEvent($event); //update event with new name

            $this->cacheClear();
        }
    }

    public function nextDay()
    {
        $this->today = $this->tomorrow;
        $this->tomorrow = Carbon::parse($this->tomorrow)->addDay()->format('d.m.Y');

        if ($this->today >= Carbon::today()) { //if today or future
            $this->displayMarked = false; //hide already marked events
        }
    }

    public function previousDay()
    {
        $yesterday = Carbon::parse($this->today)->subDay();

        $this->tomorrow = $this->today;
        $this->today = $yesterday->format('d.m.Y');

        if ($yesterday < Carbon::today()) { //if previous day already passed
            $this->displayMarked = true; //show already marked events
        }
    }

    /**
     * Clear events cache by specific key.
     */
    public function cacheClear()
    {
        Cache::delete('calendar_events_' . $this->today);
    }

    public function render()
    {
        return view('livewire.events-list')->with([
            'events' => Cache::remember('calendar_events_' . $this->today, 86400, function () { //if cached events exists return cached version
                return collect(resolve(GoogleCalendarService::class)->listEvents(Carbon::parse($this->today), Carbon::parse($this->tomorrow))->getItems());
            })->map(function (Event $event) {
                if ($this->displayMarked || $this->determineIfEventClear($event->getSummary())) {
                    return [
                        'name' => $event->getSummary(),
                        'id' => $event->id,
                        'color' => $this->getEventColor($event->colorId),
                        'startDate' => Carbon::parse($event->start->dateTime ?? $event->start->date),
                        'endDate' => Carbon::parse($event->end->dateTime ?? $event->end->date),
                        'leftTime' => $this->getEventLeftSeconds($event),
                        'marked' => !$this->determineIfEventClear($event->getSummary()),
                    ];
                }
            })->filter(),
            'displayMarked' => $this->displayMarked,
        ]);
    }
}
