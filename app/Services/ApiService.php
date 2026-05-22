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

    protected function client()
    {
        return Http::acceptJson();
    }

    public function get(string $endpoint, array $params = []): mixed
    {
        return $this->client()->get("{$this->base}/{$endpoint}", $params)->json();
    }

    public function post(string $endpoint, array $data): mixed
    {
        return $this->client()->post("{$this->base}/{$endpoint}", $data)->json();
    }

    public function put(string $endpoint, array $data): mixed
    {
        return $this->client()->put("{$this->base}/{$endpoint}", $data)->json();
    }

    public function delete(string $endpoint): bool
    {
        return $this->client()->delete("{$this->base}/{$endpoint}")->successful();
    }
}
