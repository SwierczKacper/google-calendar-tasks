<?php

namespace App\Http\Livewire\Packages;

use App\Models\Packages\Package;
use Livewire\Component;
use Livewire\WithPagination;

class PackagesList extends Component
{
    use WithPagination;

    protected $listeners = [
        '$refresh',
        'create-package-finished' => '$refresh',
        'edit-package-finished' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.packages.packages-list')->with([
            'packages' => Package::latest()->with('items')->get(),
        ]);
    }

    public function duplicate(Package $package)
    {
        $package->duplicate();
    }

    public function remove(Package $package)
    {
        $package->delete();
    }
}
