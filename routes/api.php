<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/users', function () {
//     return response()->json([
//         'message' => 'Users endpoint',
//     ]);
// });

// Categories

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show'])->whereNumber('id');
Route::post('/categories', [CategoryController::class, 'store']);
Route::put('/categories/{id}', [CategoryController::class, 'update'])->whereNumber('id');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->whereNumber('id');

// Products

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show'])->whereUuid('id');
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update'])->whereUuid('id');
Route::put('/products/{id}/inventory', [ProductController::class, 'updateInventory'])->whereUuid('id');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->whereUuid('id');
