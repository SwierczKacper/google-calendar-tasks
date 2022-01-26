<?php

namespace App\Http\Livewire;

use App\Models\Packages\Package;
use App\Models\Packages\PackageItem;
use App\Services\GoogleCalendarService;
use Google\Service\Calendar\Event;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class EditDay extends Component
{
    public ?int $package_id = null;

    public string $day_date = '';

    public string $apply_time = '';

    protected $listeners = [
        '$refresh',
    ];

    public function render()
    {
        return view('livewire.edit-day')->with([
            'events' => $this->getGoogleEvents(),
            'packages' => Package::with('items')->get(),
        ]);
    }

    public function getGoogleEvents()
    {
        if ($this->day_date != '') {
            $startDateRange = Carbon::parse($this->day_date)->setTimezone(config('app.timezone'));
            $endDateRange = clone $startDateRange;
            $endDateRange->addDay();

            return Cache::remember('calendar_events_' . $startDateRange->format('d.m.Y'), 300, function () use ($startDateRange, $endDateRange) { //if cached events exists return cached version
                return collect(resolve(GoogleCalendarService::class)->listEvents($startDateRange, $endDateRange)->getItems());
            })->map(function (Event $event) use ($startDateRange) {
                if (Carbon::parse($event->start->dateTime ?? $event->start->date)->format('d.m.Y') == $startDateRange->format('d.m.Y')) {
                    return [
                        'name' => $event->getSummary(),
                        'id' => $event->id,
                        'recurringEventId' => $event->recurringEventId,
                        'color' => $this->getEventColor($event->colorId),
                        'startDate' => Carbon::parse($event->start->dateTime ?? $event->start->date),
                        'endDate' => Carbon::parse($event->end->dateTime ?? $event->end->date),
                    ];
                }
            })->filter();
        }

        return collect([]);
    }

    public function clearAll()
    {
        $this->cacheClear();

        $startDateRange = Carbon::parse($this->day_date)->setTimezone(config('app.timezone'));

        $this->getGoogleEvents()
            ->each(function ($event) use ($startDateRange) {
                if (isset($event['recurringEventId']) && $event['recurringEventId'] != null) {
                    resolve(GoogleCalendarService::class)->deleteRecurringEvent($event['recurringEventId'], $startDateRange);
                }
            });

        $this->cacheClear();

        $this->emitSelf('$refresh');
    }

    /**
     * Clear events cache by specific key.
     */
    public function cacheClear()
    {
        $startDateRange = Carbon::parse($this->day_date)->setTimezone(config('app.timezone'));

        Cache::delete('calendar_events_' . $startDateRange->format('d.m.Y'));
    }

    public function applyPackage()
    {
        if ($this->day_date != '' && $this->apply_time != '' && $this->package_id) {
            $package = Package::with('items')->find($this->package_id);

            if ($package) {
                $previousEndDate = null;

                $package->items->each(function (PackageItem $event) use (&$previousEndDate) {
                    if ($previousEndDate) {
                        $startDate = clone $previousEndDate;
                    } else {
                        $startDate = Carbon::parse($this->day_date . ' ' . $this->apply_time);
                    }

                    $endDate = clone $startDate;
                    $endDate->addMinutes($event->duration);

                    resolve(GoogleCalendarService::class)->createWeeklyEvent($event->name . ' - ' . gmdate("H:i:s", $event->duration * 60), rand(1, 11), $startDate, $endDate);

                    $previousEndDate = clone $endDate;
                });
            }
        }

        $this->cacheClear();
        $this->emitSelf('$refresh');
    }

    public function removeEvent(string $eventId)
    {
        resolve(GoogleCalendarService::class)->deleteRecurringEvent($eventId, Carbon::parse($this->day_date)->setTimezone(config('app.timezone')));

        $this->cacheClear();
        $this->emitSelf('$refresh');
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
}
