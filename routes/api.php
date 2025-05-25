<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;

// Auth routes
Route::prefix('v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware(['auth:sanctum','throttle:60,1'])->group(function () {
        Route::post('/logout', action: [AuthController::class, 'logout']);

        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', action: [CategoryController::class, 'list']);
            Route::post('/add', action: [CategoryController::class, 'add']);
            Route::put('/update/{id}', [CategoryController::class, 'update']);
            Route::delete('/delete/{id}', [CategoryController::class, 'delete']);
        });

        Route::group(['prefix' => 'products'], function () {
            Route::get('/', action: [ProductController::class, 'list']);
            Route::get('/{id}', action: [ProductController::class, 'show']);
            Route::post('/add', action: [ProductController::class, 'add']);
            Route::put('/update/{id}', [ProductController::class, 'update']);
            Route::delete('/delete/{id}', [ProductController::class, 'delete']);
            Route::post('/{id}/inventory', [ProductController::class, 'updateInventory']);
        });
    });
});