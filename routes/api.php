<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController as ApiProductController;
use App\Http\Controllers\Api\OrderController as ApiOrderController;

// Маршруты аутентификации
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Группируем защищённые маршруты, требующие аутентификации
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Ресурсные маршруты для товаров
    Route::apiResource('products', ApiProductController::class);

    // Ресурсные маршруты для заказов
    Route::apiResource('orders', ApiOrderController::class);
});
