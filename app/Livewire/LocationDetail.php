<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Location;

class LocationDetail extends Component
{
    public $location;

    public function mount($slug)
    {
        $this->location = Location::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('locations-detail', [
            'location' => $this->location
        ]);
    }
}
