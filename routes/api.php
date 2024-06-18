<?php

use App\Http\Controllers\ApiController\ProductApiController;
use App\Http\Controllers\UserController\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::get('/order/{order}', [OrderController::class, 'OrderByUserApi'])->name('order.print');
Route::apiResource('product', ProductApiController::class);