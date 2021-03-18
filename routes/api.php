<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\HentaiController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\StarController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;


Route::get('/test', function () {
    return response()->json(['id' => 42, 'name' => 'cyan']);
});


Route::apiResource('stars', StarController::class)->parameters([
    'stars' => 'id'
]);

Route::apiResource('movies', MovieController::class)->parameters([
    'movies' => 'id'
]);

Route::apiResource('tags', TagController::class)->parameters([
    'tags' => 'id'
]);

Route::apiResource('artists', ArtistController::class)->parameters([
    'artists' => 'id'
]);

Route::apiResource('hentai', HentaiController::class)->parameters([
    'hentai' => 'id'
]);

Route::apiResource('studios', StudioController::class)->parameters([
    'studios' => 'id'
]);
