<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;

// Маршруты для управления товарами (CRUD)
Route::resource('products', ProductController::class);

// Маршруты для управления заказами
Route::resource('orders', OrderController::class)->except(['edit', 'update']);

// Отдельный маршрут для обновления статуса заказа
Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

// Маршруты для управления категориями
Route::resource('categories', CategoryController::class)->only(['index', 'create', 'store']);
