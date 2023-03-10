<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TokenController;

Route::prefix('users')->group(function () {
    Route::post('/', [UserController::class, 'store']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/{user}', [UserController::class, 'show']);
        Route::get('/{user}/tokens', [UserController::class, 'tokens']);
    });
});

Route::prefix('tokens')->group(function () {
    Route::post('/', [TokenController::class, 'store']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::delete('/', [TokenController::class, 'destroyAll']);
        Route::delete('/{id}', [TokenController::class, 'destroy']);
    });
});
