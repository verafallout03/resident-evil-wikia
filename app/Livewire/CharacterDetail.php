<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ApiService;

class CharacterDetail extends Component
{
    public array $character = [];

    protected ApiService $api;

    public function boot(ApiService $api): void
    {
        $this->api = $api;
    }

    public function mount(string $slug): void
    {
        $this->character = $this->api->get("characters/{$slug}");
    }

    public function render()
    {
        return view('characters-detail');
    }
}