<?php
 
namespace App\Livewire;
 
use Livewire\Component;
use App\Services\ApiService;
use Illuminate\Support\Facades\Session;
 
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
            $response = $this->api->get("locations/{$slug}");
            $this->location = $response['data'] ?? [];
        } catch (\Exception $e) {
            Session::flash('error', 'Locación no encontrada');
            redirect()->route('locations');
        }
    }
 
    public function render()
    {
        return view('locations-detail');
    }
}