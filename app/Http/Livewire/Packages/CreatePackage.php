<?php

namespace App\Http\Livewire\Packages;

use App\Models\Packages\Package;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class CreatePackage extends Component
{
    public string $name = '';

    protected $listeners = [
        '$refresh',
    ];

    /**
     * Define validation rules.
     */
    public function rules(): array
    {
        return [
            'name' => ['max:255', 'string'],
        ];
    }

    /**
     * @throws ValidationException
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.packages.create-package');
    }

    public function store()
    {
        Package::create([
            'name' => $this->name,
        ]);

        $this->emit('create-package-finished');

        $this->dispatchBrowserEvent('livewire-close-create-package-modal');
    }
}
