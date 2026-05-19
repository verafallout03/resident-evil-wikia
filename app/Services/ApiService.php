<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiService
{
    protected string $base;

    public function __construct()
    {
        $this->base = config('app.url') . '/api';
    }

    public function get(string $endpoint, array $params = []): mixed
    {
        return Http::get("{$this->base}/{$endpoint}", $params)->json();
    }

    public function post(string $endpoint, array $data): mixed
    {
        return Http::post("{$this->base}/{$endpoint}", $data)->json();
    }

    public function put(string $endpoint, array $data): mixed
    {
        return Http::put("{$this->base}/{$endpoint}", $data)->json();
    }

    public function delete(string $endpoint): bool
    {
        return Http::delete("{$this->base}/{$endpoint}")->successful();
    }
}