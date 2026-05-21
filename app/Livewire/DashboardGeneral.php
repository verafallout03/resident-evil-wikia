<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ApiService;

class DashboardGeneral extends Component
{
    public array $items = [];
    public array $pagination = [];
    public int $page = 1;

    protected ApiService $api;

    public function boot(ApiService $api): void
    {
        $this->api = $api;
    }

    public function mount(): void
    {
        $this->loadItems();
    }

    public function loadItems(): void
    {
        try {
            $base = config('app.url') . '/api';

            // Llamadas paralelas a los 3 endpoints
            [$chars, $games, $locs] = \Illuminate\Support\Facades\Http::pool(fn($pool) => [
                $pool->get("{$base}/characters", ['page' => $this->page, 'per_page' => 4]),
                $pool->get("{$base}/games",      ['page' => $this->page, 'per_page' => 4]),
                $pool->get("{$base}/locations",  ['page' => $this->page, 'per_page' => 4]),
            ]);

            // Combinar respuestas
            $this->items = collect()
                ->merge(collect($chars->json('data'))->map(fn($i) => [...$i, 'type' => 'character']))
                ->merge(collect($games->json('data'))->map(fn($i) => [...$i, 'type' => 'game', 'image' => $i['cover_image'] ?? null]))
                ->merge(collect($locs->json('data'))->map(fn($i) => [...$i, 'type' => 'location']))
                ->shuffle()
                ->values()
                ->toArray();

            $this->pagination = [
                'current_page' => $this->page,
                'last_page' => max(
                    $chars->json('last_page') ?? 1,
                    $games->json('last_page') ?? 1,
                    $locs->json('last_page') ?? 1
                ),
            ];
        } catch (\Exception $e) {
            session()->flash('error', 'Error al cargar elementos: ' . $e->getMessage());
            $this->items = [];
            $this->pagination = ['current_page' => 1, 'last_page' => 1];
        }
    }

    public function nextPage(): void
    {
        if ($this->page < $this->pagination['last_page']) {
            $this->page++;
            $this->loadItems();
        }
    }

    public function prevPage(): void
    {
        if ($this->page > 1) {
            $this->page--;
            $this->loadItems();
        }
    }

    public function render()
    {
        return view('dashboard-general');
    }
}