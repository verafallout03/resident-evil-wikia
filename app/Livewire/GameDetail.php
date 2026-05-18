<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Game;

class GameDetail extends Component
{
    public $game;

    public function mount($slug)
    {
        $this->game = Game::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('games-detail', [
            'game' => $this->game
        ]);
    }
}
