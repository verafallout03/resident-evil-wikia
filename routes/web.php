<?php

use App\Http\Controllers\Api\CharacterController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\DashboardController;
use App\Livewire\CharacterDetail;
use App\Livewire\Characters;
use App\Livewire\DashboardGeneral;
use App\Livewire\GameDetail;
use App\Livewire\Games;
use App\Livewire\LocationDetail;
use App\Livewire\Locations;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

// Dashboard: redirects to the role-appropriate dashboard
Route::get('dashboard', [DashboardController::class, 'redirect'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Admin dashboard (Gate: admin)
Route::get('dashboard/admin', [DashboardController::class, 'admin'])
    ->middleware(['auth', 'verified', 'can:admin'])
    ->name('dashboard.admin');

// Editor dashboard (Gate: editor)
Route::get('dashboard/editor', [DashboardController::class, 'editor'])
    ->middleware(['auth', 'verified', 'can:editor'])
    ->name('dashboard.editor');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Livewire public views
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard-general', DashboardGeneral::class)->name('dashboard-general');
    Route::get('/dashboard-games', Games::class)->name('games');
    Route::get('/dashboard-locations', Locations::class)->name('locations');
    Route::get('/dashboard-characters', Characters::class)->name('characters');
    Route::get('/characters/{slug}', CharacterDetail::class)->name('characters-detail');
    Route::get('/locations/{slug}', LocationDetail::class)->name('locations-detail');
    Route::get('/games/{slug}', GameDetail::class)->name('games-detail');
});

// Admin CRUD (cualquier usuario autenticado)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('games', GameController::class)->except(['show']);
    Route::resource('characters', CharacterController::class)->except(['show']);
    Route::resource('locations', LocationController::class)->except(['show']);
});

// Reportes PDF (solo administradores)
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin/reports')->name('admin.reports.')->group(function () {
    Route::get('/', [ReportController::class, 'index'])->name('index');
    Route::get('/characters', [ReportController::class, 'characters'])->name('characters');
    Route::get('/games', [ReportController::class, 'games'])->name('games');
    Route::get('/locations', [ReportController::class, 'locations'])->name('locations');
});

require __DIR__.'/auth.php';
