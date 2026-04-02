<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Bisa diakses tanpa token)
|--------------------------------------------------------------------------
*/
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']); // <--- INI YANG KURANG TADI!


/*
|--------------------------------------------------------------------------
| Protected Routes (Harus Login / Bawa Token)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {
    
    // Auth & Profile
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // --- TAMBAHKAN INI UNTUK UPDATE PROFIL ---
    Route::post('/user/update/{id}', [UserController::class, 'updateProfile']);

    // Books
    Route::apiResource('books', BookController::class);

    // Transaksi Siswa
    Route::post('/borrow', [TransactionController::class, 'borrow']);
    Route::post('/return', [TransactionController::class, 'returnBook']);
    Route::get('/my-peminjaman', [PeminjamanController::class, 'riwayat']); 
    Route::post('/pinjam', [PeminjamanController::class, 'pinjam']);
    Route::post('/kembalikan/{id}', [PeminjamanController::class, 'kembalikan']);
    Route::get('/riwayat-selesai', [PeminjamanController::class, 'riwayatSelesai']);

    // Admin Access
    Route::get('/admin/peminjaman', [PeminjamanController::class, 'allTransaksi']);
    Route::get('/admin/users', [UserController::class, 'index']);
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy']);
});