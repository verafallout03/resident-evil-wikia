<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CharacterController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth endpoints
Route::prefix('auth')->name('api.auth.')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login',    [AuthController::class, 'login'])->name('login');
    Route::post('/logout',   [AuthController::class, 'logout'])->name('logout')->middleware('auth:sanctum');
});

// Authenticated user info
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public read-only endpoints
Route::apiResource('games',      GameController::class)->only(['index', 'show']);
Route::apiResource('characters', CharacterController::class)->only(['index', 'show']);
Route::apiResource('locations',  LocationController::class)->only(['index', 'show']);

// Protected write endpoints (require Sanctum token)
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('games',      GameController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('characters', CharacterController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('locations',  LocationController::class)->only(['store', 'update', 'destroy']);
});
