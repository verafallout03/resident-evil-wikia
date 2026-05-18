<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Character;

class Characters extends Component
{
    use WithPagination;

    public function render()
    {
        $characters = Character::select('id','name','slug','image')
            ->orderByRaw('RAND()') // 👈 revuelto
            ->paginate(12);

        return view('characters', compact('characters'));
    }
}
