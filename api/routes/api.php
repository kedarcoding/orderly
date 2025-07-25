<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;


// Order routes
Route::get('/orders', [OrderController::class, 'index']);
Route::post('/orders', [OrderController::class, 'store']);
Route::patch('/orders/{id}', [OrderController::class, 'updateStatus']);

   

