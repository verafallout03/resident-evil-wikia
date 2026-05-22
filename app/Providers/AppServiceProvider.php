<?php

namespace App\Providers;

use App\Listeners\SendWelcomeEmail;
use App\Services\ApiService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ApiService::class);
    }

    public function boot(): void
    {
        Event::listen(Registered::class, SendWelcomeEmail::class);
    }
}
