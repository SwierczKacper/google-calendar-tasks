<?php

namespace App\Http\Livewire\Packages;

use App\Models\Packages\Package;
use App\Models\Packages\PackageItem;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;

class Calculator extends Component
{
    public string $calculatorStart = '';

    public string $calculatorEnd = '?';

    public array $calculatorItems = [];

    protected $listeners = [
        '$refresh',
    ];

    public function render()
    {
        return view('livewire.packages.calculator')->with([
            'packages' => Package::all(),
        ]);
    }

    public function updatedCalculatorStart()
    {
        $this->calculate();
    }

    public function updatedCalculatorItems($value, $name)
    {
        if ($value != '' && $this->calculatorStart != '') { //if not selected "Delete" option
            $this->calculate();
        } elseif (isset($this->calculatorItems[Str::before($name, '.')])) {
            unset($this->calculatorItems[Str::before($name, '.')]);

            $this->calculate();
        }
    }

    public function calculate()
    {
        $start = Carbon::parse($this->calculatorStart)->setTimezone(config('app.timezone'));
        $end = clone $start;

        foreach ($this->calculatorItems as $key => $item) {
            $this->calculatorItems[$key]['start'] = clone $end;

            $this->calculatorItems[$key]['items'] = Package::find($item['id'])->items->map(function (PackageItem $packageItem) use (&$end) {
                $newItem['id'] = $packageItem->id;
                $newItem['name'] = $packageItem->name;
                $newItem['duration'] = $packageItem->duration;
                $newItem['start'] = clone $end;

                $end->addMinutes($packageItem->duration);

                $newItem['end'] = clone $end;

                return $newItem;
            })->toArray();

            $this->calculatorItems[$key]['end'] = clone $end;
        }

        $this->calculatorEnd = $end->format('H:i');
    }

    public function addItem()
    {
        $newPackage = Package::limit(1)->get('id')->first();

        $start = Carbon::parse($this->calculatorStart)->setTimezone(config('app.timezone'));
        $end = clone $start;

        $this->calculatorItems[] = [
            'id' => $newPackage->id,
            'items' => $newPackage->items->map(function (PackageItem $packageItem) use (&$end) {
                $newItem['id'] = $packageItem->id;
                $newItem['name'] = $packageItem->name;
                $newItem['duration'] = $packageItem->duration;
                $newItem['start'] = clone $end;

                $end->addMinutes($packageItem->duration);

                $newItem['end'] = clone $end;

                return $newItem;
            })->toArray(),
        ];

        $this->updatedCalculatorItems($newPackage, count($this->calculatorItems) - 1);
    }

    public function refresh()
    {
        $this->calculate();
    }

    public function clear()
    {
        $this->calculatorItems = [];

        $this->calculate();
    }
}
