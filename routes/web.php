<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\PembayaranController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('penghuni', PenghuniController::class);
Route::resource('pembayaran', PembayaranController::class);
