<?php
 
namespace App\Livewire;
 
use Livewire\Component;
use App\Services\ApiService;
 
class LocationDetail extends Component
{
    public array $location = [];
 
    protected ApiService $api;
 
    public function boot(ApiService $api): void
    {
        $this->api = $api;
    }
 
    public function mount(string $slug): void
    {
        try {
            $this->location = $this->api->get("locations/{$slug}");
        } catch (\Exception $e) {
            session()->flash('error', 'Locación no encontrada');
            redirect()->route('locations');
        }
    }
 
    public function render()
    {
        return view('locations-detail');
    }
}