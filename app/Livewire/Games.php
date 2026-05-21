<?php
 
namespace App\Livewire;
 
use Livewire\Component;
use App\Services\ApiService;
 
class Games extends Component
{
    public array $games = [];
    public array $pagination = [];
    public int $page = 1;
 
    protected ApiService $api;
 
    public function boot(ApiService $api): void
    {
        $this->api = $api;
    }
 
    public function mount(): void
    {
        $this->loadGames();
    }
 
    public function loadGames(): void
    {
        try {
            $response = $this->api->get('games', [
                'page'     => $this->page,
                'per_page' => 12,
            ]);
 
            $this->games = $response['data'] ?? [];
            $this->pagination = [
                'current_page' => $response['current_page'] ?? 1,
                'last_page'    => $response['last_page'] ?? 1,
            ];
        } catch (\Exception $e) {
            session()->flash('error', 'Error al cargar juegos: ' . $e->getMessage());
            $this->games = [];
        }
    }
 
    public function nextPage(): void
    {
        if ($this->page < $this->pagination['last_page']) {
            $this->page++;
            $this->loadGames();
        }
    }
 
    public function prevPage(): void
    {
        if ($this->page > 1) {
            $this->page--;
            $this->loadGames();
        }
    }
 
    public function render()
    {
        return view('games');
    }
}