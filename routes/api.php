<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/tanaman', [\App\Http\Controllers\Api\TanamanApiController::class, 'index']);
Route::get('/tanaman/{id}', [\App\Http\Controllers\Api\TanamanApiController::class, 'show']);
