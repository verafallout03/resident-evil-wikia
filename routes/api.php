<?php

use App\Http\Controllers\Api\CharacterController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('characters', CharacterController::class);
Route::apiResource('games', GameController::class);
Route::apiResource('locations', LocationController::class);
