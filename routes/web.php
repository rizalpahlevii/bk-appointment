<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\DaftarPoliController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\RiwayatPasienController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    if (session('login')) {
        return redirect()->route('dashboard');
    }
    return view('pages.landing');
})->name('dashboard');

Route::get('daftar', [DaftarController::class, 'index'])->name('daftar.index');
Route::post('daftar', [DaftarController::class, 'store'])->name('daftar.store');

Route::get('daftar-poli', [DaftarPoliController::class, 'index'])->name('daftar-poli.index');
Route::post('daftar-poli', [DaftarPoliController::class, 'store'])->name('daftar-poli.store');

Route::middleware(['my-auth'])->group(function () {

    Route::resource('obat', ObatController::class);

    Route::get('riwayat', [RiwayatPasienController::class, 'index'])->name('riwayat-pasien.index');
    Route::get('periksa', [PeriksaController::class, 'index'])->name('periksa.index');
});

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'attemptLogin'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
