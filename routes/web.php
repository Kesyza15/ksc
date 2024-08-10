<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\SimpananPokokController;
use App\Http\Controllers\SimpananWajibController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\AngsuranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/', [UserController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    
    // Routes for Anggota
    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
    Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');
    Route::post('/anggota/store', [AnggotaController::class, 'store'])->name('anggota.store');
    Route::get('/anggota/{anggota}', [AnggotaController::class, 'show'])->name('anggota.show');
    Route::get('/anggota/{anggota}/edit', [AnggotaController::class, 'edit'])->name('anggota.edit');
    Route::put('/anggota/{anggota}/update', [AnggotaController::class, 'update'])->name('anggota.update');
    Route::delete('/anggota/{anggota}/destroy', [AnggotaController::class, 'destroy'])->name('anggota.destroy');

    // Routes for Simpanan Pokok
    Route::resource('simpanan-pokok', SimpananPokokController::class);
   
    // Routes for Simpanan Wajib
    Route::get('/simpanan-wajib', [SimpananWajibController::class, 'index'])->name('simpanan-wajib.index');
    Route::get('/simpanan-wajib/create', [SimpananWajibController::class, 'create'])->name('simpanan-wajib.create');
    Route::post('/simpanan-wajib/store', [SimpananWajibController::class, 'store'])->name('simpanan-wajib.store');
    
    // Routes for Tabungan
    Route::get('tabungan', [TabunganController::class, 'index'])->name('tabungan.index');
    Route::get('tabungan/{anggota_id}/create', [TabunganController::class, 'create'])->name('tabungan.create');
    Route::post('tabungan', [TabunganController::class, 'store'])->name('tabungan.store');
    Route::get('tabungan/{anggota_id}', [TabunganController::class, 'show'])->name('tabungan.show');
    Route::get('tabungan/{anggota_id}/withdraw', [TabunganController::class, 'withdraw'])->name('tabungan.withdraw');
    Route::post('tabungan/{anggota_id}/process-withdraw', [TabunganController::class, 'processWithdraw'])->name('tabungan.processWithdraw');

    // Routes for Pinjaman
    Route::resource('pinjaman', PinjamanController::class);
    Route::get('/angsuran/create/{pinjaman_id}', [AngsuranController::class, 'create'])->name('angsuran.create');
    Route::post('/angsuran/store/{pinjaman_id}', [AngsuranController::class, 'store'])->name('angsuran.store');

    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    });

Route::get('/welcome', function () {
    return view('welcome');
});