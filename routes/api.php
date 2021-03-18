<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\StarController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;


Route::get('/test', function () {
    return response()->json(['id' => 42, 'name' => 'cyan']);
});


Route::apiResource('stars', StarController::class);
Route::apiResource('movies', MovieController::class);
Route::apiResource('tags', TagController::class);
