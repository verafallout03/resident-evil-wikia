<?php

use App\Livewire\Characters;
use App\Livewire\DashboardGeneral;
use App\Livewire\Games;
use App\Livewire\Locations;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard-general', DashboardGeneral::class)->name('dashboard-general');
    Route::get('/dashboard-games', Games::class)->name('games');
    Route::get('/dashboard-locations', Locations::class)->name('locations');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard-characters', Characters::class)->name('characters');
});


require __DIR__.'/auth.php';
