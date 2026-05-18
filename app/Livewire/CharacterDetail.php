<?php 

namespace App\Livewire;

use Livewire\Component;
use App\Models\Character;

class CharacterDetail extends Component
{
    public $character;

    public function mount($slug)
    {
        $this->character = Character::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('characters-detail', [
            'character' => $this->character
        ]);
    }
}
