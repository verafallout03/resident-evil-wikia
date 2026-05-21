<?php
 
namespace App\Livewire;
 
use Livewire\Component;
use App\Services\ApiService;
 
class GameDetail extends Component
{
    public array $game = [];
 
    protected ApiService $api;
 
    public function boot(ApiService $api): void
    {
        $this->api = $api;
    }
 
    public function mount(string $slug): void
    {
        try {
            $this->game = $this->api->get("games/{$slug}");
        } catch (\Exception $e) {
            session()->flash('error', 'Juego no encontrado');
            redirect()->route('games');
        }
    }
 
    public function render()
    {
        return view('games-detail');
    }
}