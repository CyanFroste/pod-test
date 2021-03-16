<?php

use Illuminate\Support\Facades\Route;


Route::get('/test', function () {
    return response()->json(['id' => 42, 'name' => 'cyan']);
});
