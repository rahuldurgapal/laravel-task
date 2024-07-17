<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\ApiKeyMiddleware;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(ApiKeyMiddleware::class)->prefix('todo')->group(function() {
    Route::post('/add',[TaskController::class,'addTask']);
    Route::post('/status',[TaskController::class,'changeStatus']);
});


