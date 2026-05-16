<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Character;
use App\Models\Location;
use App\Models\Game;

class DashboardGeneral extends Component
{
    public $items;

    public function mount()
    {
        // Traer registros con campos clave
        $characters = Character::select('id','name','slug','image')->get()
            ->map(function($c) {
                return [
                    'type' => 'character',
                    'id'   => $c->id,
                    'name' => $c->name,
                    'slug' => $c->slug,
                    'image'=> $c->image,
                ];
            });

        $locations = Location::select('id','name','slug','image')->get()
            ->map(function($l) {
                return [
                    'type' => 'location',
                    'id'   => $l->id,
                    'name' => $l->name,
                    'slug' => $l->slug,
                    'image'=> $l->image,
                ];
            });

        $games = Game::select('id','title as name','slug','cover_image as image')->get()
            ->map(function($g) {
                return [
                    'type' => 'game',
                    'id'   => $g->id,
                    'name' => $g->name,
                    'slug' => $g->slug,
                    'image'=> $g->image,
                ];
            });

        // Mezclar todo y revolver
        $this->items = $characters
            ->concat($locations)
            ->concat($games)
            ->shuffle();
    }

    public function render()
    {
        return view('dashboard-general');
    }
}
