<?php
 
namespace App\Livewire;
 
use Livewire\Component;
use App\Services\ApiService;
use Illuminate\Support\Facades\Session;
 
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
                'per_page' => 6,
            ]);
 
            $this->games = $response['data'] ?? [];
            $this->pagination = [
                'current_page' => $response['meta']['current_page'] ?? 1,
                'last_page'    => $response['meta']['last_page'] ?? 1,
            ];
        } catch (\Exception $e) {
            Session::flash('error', 'Error al cargar juegos: ' . $e->getMessage());
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