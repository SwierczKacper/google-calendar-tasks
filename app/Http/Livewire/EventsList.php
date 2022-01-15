<?php

namespace App\Http\Livewire;

use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Livewire\Component;
use Spatie\GoogleCalendar\Event;
use Symfony\Component\ErrorHandler\Debug;

class EventsList extends Component
{
    public string $today;
    public string $tomorrow;

    private Collection $events;

    public function boot()
    {
        $this->today = Carbon::today()->format('d.m.Y'); //first day for events
        $this->tomorrow = Carbon::tomorrow()->format('d.m.Y'); //last day for events

        $this->events = Cache::remember('events_' . $this->today, 86400, function () { //if cached events exists return cached version
            return Event::get(Carbon::parse($this->today), Carbon::parse($this->tomorrow)); //get events in specific range
        })->map(function ($event) {
            if (!Str::contains($event->name, __('calendar.done_suffix')) && !Str::contains($event->name, __('calendar.skipped_suffix'))) { //if event isn`t already marked as done or skipped
                return [
                    'name' => $event->name,
                    'id' => $event->id,
                    'color' => $this->getEventColor($event->colorId),
                    'startDate' => Carbon::parse($event->start->dateTime ?? $event->start->date),
                    'endDate' => Carbon::parse($event->end->dateTime ?? $event->end->date),
                    'leftTime' => $this->getEventLeftSeconds($event),
                ];
            }
        })->filter();

        \Debugbar::info('test');
    }

    /**
     * Return event left time to end date in seconds.
     */
    public function getEventLeftSeconds($event): int
    {
        if(Carbon::now() > Carbon::parse($event->start->dateTime ?? $event->start->date) && Carbon::now() < Carbon::parse($event->end->dateTime ?? $event->end->date)) {
            return Carbon::parse($event->end->dateTime ?? $event->end->date)->diffInSeconds(Carbon::now());
        }

        return 0;
    }

    /**
     * Return hex color for event.
     */
    public function getEventColor(int $colorId): string
    {
        if(config('google-calendar.colors') && Arr::has(config('google-calendar.colors'), $colorId)) {
            $color = config('google-calendar.colors')[$colorId];
        }

        return $color ?? '#fff';
    }

    public function render()
    {
        return view('livewire.events-list')->with([
            'events' => $this->events
        ]);
    }
}