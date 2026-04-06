<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/tanaman', [\App\Http\Controllers\Api\TanamanApiController::class, 'index']);
Route::get('/tanaman/{id}', [\App\Http\Controllers\Api\TanamanApiController::class, 'show']);

Route::get('/categories', function() {
    return response()->json([
        'success' => true,
        'data' => \App\Models\Category::all()
    ]);
});

Route::get('/config/ai-model', [\App\Http\Controllers\Api\AppConfigApiController::class, 'aiModel']);
Route::post('/identifikasi/log', [\App\Http\Controllers\Api\IdentifikasiLogApiController::class, 'store']);

Route::middleware('verify.apikey')->post('/contributions', [\App\Http\Controllers\Api\ContributionApiController::class, 'store']);
