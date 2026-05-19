<?php

use App\Http\Controllers\Api\CharacterController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\LocationController;

Route::apiResource('characters', CharacterController::class)->parameters([
    'characters' => 'slug'
]);
Route::apiResource('games', GameController::class)->parameters([
    'games' => 'slug'
]);
Route::apiResource('locations', LocationController::class)->parameters([
    'locations' => 'slug'
]);