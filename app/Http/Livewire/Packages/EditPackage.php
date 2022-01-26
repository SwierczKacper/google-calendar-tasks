<?php

namespace App\Http\Livewire\Packages;

use App\Models\Packages\Package;
use App\Models\Packages\PackageItem;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class EditPackage extends Component
{
    public Package $package;

    public string $name = '';

    public array $items = [];

    public array $newItem = [];

    protected $listeners = [
        '$refresh',
    ];

    /**
     * Define validation rules.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:0', 'max:255', 'string'],
            'newItem.name' => ['required', 'max:255', 'string'],
            'newItem.duration' => ['required', 'min:0', 'integer'],
        ];
    }

    /**
     * @throws ValidationException
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Grab values from model.
     */
    public function mount(Package $package)
    {
        $this->name = $package->name;
        $this->items = $package->items()
            ->get(['name', 'duration'])->toArray();
    }

    public function render()
    {
        return view('livewire.packages.edit-package')->with([
            'summaryTime' => collect($this->items)
                ->sum('duration'),
        ]);
    }

    public function addNewItem()
    {
        $this->validate();

        $this->items[] = [
            'name' => $this->newItem['name'],
            'duration' => (int) $this->newItem['duration'] ?? 0,
        ];

        $this->reset('newItem');

        $this->emitSelf('$refresh');
    }

    public function removeItem(int $index)
    {
        if ($this->items[$index]) {
            unset($this->items[$index]);
        }
    }

    public function moveItem(int $index, int $upOrDown)
    {
        array_move($this->items, $index, $index + $upOrDown);
    }

    public function save()
    {
        $this->package->update([
            'name' => $this->name,
        ]);

        $this->package->items()
            ->delete();

        foreach ($this->items as $item) {
            PackageItem::create([
                'package_id' => $this->package->id,
                'name' => $item['name'],
                'duration' => $item['duration'],
            ]);
        }
    }
}
