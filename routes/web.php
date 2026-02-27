<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UlasanController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('penghuni', PenghuniController::class);
Route::resource('pembayaran', PembayaranController::class);
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/ulasan/create', [UlasanController::class, 'create']);
Route::post('/ulasan/store', [UlasanController::class, 'store']);
