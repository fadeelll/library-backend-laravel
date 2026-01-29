<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Endpoint Public (Bisa diakses tanpa login)
Route::post('/login', [AuthController::class, 'login']);

// Endpoint Protected (Harus login/bawa token)
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('books', BookController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Nanti route buku & transaksi taruh di sini
});
