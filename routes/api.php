<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CharacterController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\LocationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('characters', CharacterController::class)->parameters([
    'characters' => 'slug'
]);

Route::apiResource('games', GameController::class)->parameters([
    'games' => 'slug'
]);

Route::apiResource('locations', LocationController::class)->parameters([
    'locations' => 'slug'
]);