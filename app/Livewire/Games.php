<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Game;

class Games extends Component
{
    use WithPagination;

    public function render()
    {
        $games = Game::select('id','title as name','slug','cover_image as image')
            ->orderByRaw('RAND()')
            ->paginate(12);

        return view('games', compact('games'));
    }
}
