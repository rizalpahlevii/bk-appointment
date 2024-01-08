<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\DaftarPoliController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalPeriksaController;
use App\Http\Controllers\JsonController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\RiwayatPasienController;
use App\Http\Controllers\RiwayatPeriksaController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('daftar', [DaftarController::class, 'index'])->name('daftar.index');
Route::post('daftar', [DaftarController::class, 'store'])->name('daftar.store');

Route::get('daftar-poli', [DaftarPoliController::class, 'index'])->name('daftar-poli.index');
Route::post('daftar-poli', [DaftarPoliController::class, 'store'])->name('daftar-poli.store');

Route::middleware(['my-auth'])->group(function () {
    Route::get('riwayat-periksa', [RiwayatPeriksaController::class, 'index'])->name('riwayat-periksa.index');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('obat', ObatController::class);
    Route::resource('dokter', DokterController::class);
    Route::resource('jadwal-periksa', JadwalPeriksaController::class);
    Route::post('jadwal-periksa/{id}', [JadwalPeriksaController::class, 'switchStatus'])->name('jadwal-periksa.switch');
    Route::get('riwayat', [RiwayatPasienController::class, 'index'])->name('riwayat-pasien.index');
    Route::get('riwayat/{pasienId}', [RiwayatPasienController::class, 'show'])->name('riwayat-pasien.show');
    Route::resource('periksa', PeriksaController::class)->only(['index', 'show', 'edit', 'update', 'store']);
});

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'attemptLogin'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('json')->group(function () {
    Route::get('poli/{id}/jadwal', [JsonController::class, 'getJadwalByPoliId'])->name('json.poli.jadwal');
});
