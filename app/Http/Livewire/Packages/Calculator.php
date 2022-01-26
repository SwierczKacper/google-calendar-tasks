<?php

namespace App\Http\Livewire\Packages;

use App\Models\Packages\Package;
use Carbon\Carbon;
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
        if ($value != '' && $this->calculatorStart != '') {
            $this->calculate();
        } elseif (isset($this->calculatorItems[$name])) {
            unset($this->calculatorItems[$name]);

            $this->calculate();
        }
    }

    public function calculate()
    {
        $start = Carbon::parse($this->calculatorStart)->setTimezone(config('app.timezone'));
        $end = clone $start;

        foreach ($this->calculatorItems as $item) {
            $end->addMinutes(Package::with('items')->find($item)->getSummaryTime());
        }

        $this->calculatorEnd = $end->format('H:i');
    }

    public function addItem()
    {
        $newPackage = Package::limit(1)->get('id')->first()->id;

        $this->calculatorItems[] = $newPackage;

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
