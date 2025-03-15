<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController as ApiProductController;
use App\Http\Controllers\Api\OrderController as ApiOrderController;

// Ресурсные маршруты для товаров
Route::apiResource('products', ApiProductController::class);

// Ресурсные маршруты для заказов
Route::apiResource('orders', ApiOrderController::class);
