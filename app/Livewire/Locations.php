<?php
 
namespace App\Livewire;
 
use Livewire\Component;
use App\Services\ApiService;
 
class Locations extends Component
{
    public array $locations = [];
    public array $pagination = [];
    public int $page = 1;
 
    protected ApiService $api;
 
    public function boot(ApiService $api): void
    {
        $this->api = $api;
    }
 
    public function mount(): void
    {
        $this->loadLocations();
    }
 
    public function loadLocations(): void
    {
        try {
            $response = $this->api->get('locations', [
                'page'     => $this->page,
                'per_page' => 12,
            ]);
 
            $this->locations = $response['data'] ?? [];
            $this->pagination = [
                'current_page' => $response['current_page'] ?? 1,
                'last_page'    => $response['last_page'] ?? 1,
            ];
        } catch (\Exception $e) {
            session()->flash('error', 'Error al cargar locaciones: ' . $e->getMessage());
            $this->locations = [];
        }
    }
 
    public function nextPage(): void
    {
        if ($this->page < $this->pagination['last_page']) {
            $this->page++;
            $this->loadLocations();
        }
    }
 
    public function prevPage(): void
    {
        if ($this->page > 1) {
            $this->page--;
            $this->loadLocations();
        }
    }
 
    public function render()
    {
        return view('locations');
    }
}
