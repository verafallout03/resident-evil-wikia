<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Location;

class Locations extends Component
{
    use WithPagination;

    public function render()
    {
        $locations = Location::select('id','name','slug','image')
            ->orderByRaw('RAND()')
            ->paginate(12);

        return view('locations', compact('locations'));
    }
}