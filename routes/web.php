<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});
/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Penghuni
|--------------------------------------------------------------------------
*/
Route::resource('penghuni', PenghuniController::class);
Route::delete('/penghuni/{id}', [PenghuniController::class, 'destroy'])
    ->name('penghuni.destroy');

/*
|--------------------------------------------------------------------------
| Pembayaran
|--------------------------------------------------------------------------
*/
Route::resource('pembayaran', PembayaranController::class);

/*
|--------------------------------------------------------------------------
| WhatsApp Kirim Tagihan
|--------------------------------------------------------------------------
*/
Route::get('/pembayaran/{id}/kirim-wa', [PembayaranController::class, 'kirimWa']);

/*
|--------------------------------------------------------------------------
| Ulasan
|--------------------------------------------------------------------------
*/
Route::get('/ulasan/terima-kasih', function(){
    return view('ulasan.terima_kasih');
})->name('ulasan.terimakasih');

Route::get('/ulasan/create/{id_pembayaran}', [UlasanController::class, 'create'])
    ->name('ulasan.create');

Route::post('/ulasan/store', [UlasanController::class, 'store'])
    ->name('ulasan.store');


    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');