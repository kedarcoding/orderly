<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\api\ItemController;
use App\Http\Controllers\api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout']);

    // Items routes
    Route::resorce('/Items', [ItemController::class]);
    

    // Orders routes
    Route::resorce('/myOrders', [OrderController::class]);

});
