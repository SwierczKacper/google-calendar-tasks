<?php

namespace App\Http\Livewire;

use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Livewire\Component;
use Spatie\GoogleCalendar\Event;

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
    public function getEventColor(int $colorId): string
    {
        if (config('google-calendar.colors') && Arr::has(config('google-calendar.colors'), $colorId)) {
            $color = config('google-calendar.colors')[$colorId];
        }

        return $color ?? '#fff';
    }

    /**
     * Mark event as done or skipped by changing it`s name.
     */
    public function markEventAs(string $eventId, string $action): void
    {
        $event = Event::find($eventId); //find google calendar event by id

        if ($this->determineIfEventClear($event->name)) { //check if name can be changed
            $event->name .= __('calendar.' . $action . '_suffix'); //change name
            $event->save(); //save event

            $this->cacheClear();
        }
    }

    public function nextDay()
    {
        $this->today = Carbon::parse($this->today)->addDay()->format('d.m.Y');
        $this->tomorrow = Carbon::parse($this->tomorrow)->addDay()->format('d.m.Y');
    }

    public function previousDay()
    {
        $this->today = Carbon::parse($this->today)->subDay()->format('d.m.Y');
        $this->tomorrow = Carbon::parse($this->tomorrow)->subDay()->format('d.m.Y');
    }

    /**
     * Clear events cache by specific key.
     */
    public function cacheClear()
    {
        Cache::delete('calendar_events_' . $this->today); //clear cache, because in method boot() we are loading cached events
    }

    public function render()
    {
        return view('livewire.events-list')->with([
            'events' => Cache::remember('calendar_events_' . $this->today, 86400, function () { //if cached events exists return cached version
                return Event::get(Carbon::parse($this->today), Carbon::parse($this->tomorrow)); //get events in specific range
            })->map(function ($event) {
                if ($this->displayMarked || $this->determineIfEventClear($event->name)) {
                    return [
                        'name' => $event->name,
                        'id' => $event->id,
                        'color' => $this->getEventColor($event->colorId),
                        'startDate' => Carbon::parse($event->start->dateTime ?? $event->start->date),
                        'endDate' => Carbon::parse($event->end->dateTime ?? $event->end->date),
                        'leftTime' => $this->getEventLeftSeconds($event),
                        'marked' => !$this->determineIfEventClear($event->name),
                    ];
                }
            })->filter(),
            'displayMarked' => $this->displayMarked,
        ]);
    }
}
