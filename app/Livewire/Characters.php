<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ApiService;

class Characters extends Component
{
    public array $characters = [];
    public array $pagination = [];

    public int $page = 1;

    protected ApiService $api;

    public function boot(ApiService $api): void
    {
        $this->api = $api;
    }

    public function mount(): void
    {
        $this->loadCharacters();
    }

    public function loadCharacters(): void
    {
        $response = $this->api->get('characters', [
            'page'     => $this->page,
            'per_page' => 6,
        ]);

        $this->characters = $response['data'] ?? [];
        $this->pagination = [
            'current_page' => $response['current_page'] ?? 1,
            'last_page'    => $response['last_page'] ?? 1,
        ];
    }

    public function nextPage(): void
    {
        if ($this->page < $this->pagination['last_page']) {
            $this->page++;
            $this->loadCharacters();
        }
    }

    public function prevPage(): void
    {
        if ($this->page > 1) {
            $this->page--;
            $this->loadCharacters();
        }
    }

    public function render()
    {
        return view('characters');
    }
}