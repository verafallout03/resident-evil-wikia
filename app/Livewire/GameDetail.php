<?php
 
namespace App\Livewire;
 
use Livewire\Component;
use App\Services\ApiService;
use Illuminate\Support\Facades\Session;
 
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
            $response = $this->api->get("games/{$slug}");
            $this->game = $response['data'] ?? [];
        } catch (\Exception $e) {
            Session::flash('error', 'Juego no encontrado');
            redirect()->route('games');
        }
    }
 
    public function render()
    {
        return view('games-detail');
    }
}