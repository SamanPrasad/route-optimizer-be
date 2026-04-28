<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EdgeController;
use App\Http\Controllers\NodeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/node', [NodeController::class, 'create'])->middleware('auth:sanctum');
Route::get('/nodes', [NodeController::class, 'all'])->middleware('auth:sanctum');
ROute::post('/edge', [EdgeController::class, 'create'])->middleware('auth:sanctum');

Route::post('/shortest-path', [NodeController::class, 'shortestPath'])->middleware('auth:sanctum');
