<?php

use App\Http\Controllers\CamabaController;
use App\Models\Monitoring;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mahasiswa\LoginController as MahasiswaLoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Mahasiswa\MouController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\Mahasiswa\DataDiriController;
use App\Http\Controllers\Mahasiswa\LogoutController;
use App\Http\Controllers\Mahasiswa\MonitoringController;
use App\Http\Livewire\Mahasiswa\ShowMou;

Route::get('kabupaten', KabupatenController::class);
Route::get('kecamatan', KecamatanController::class);
Route::get('kelurahan', KelurahanController::class);

Route::middleware('guest:web,mahasiswa')->group(function() {
    Route::get('register', [RegisterController::class, 'index']);
    Route::post('register', [RegisterController::class, 'store']);

    Route::get('mahasiswa-beastudi', [MahasiswaLoginController::class, 'index'])->name('login');
    Route::post('mahasiswa-beastudi', [MahasiswaLoginController::class, 'store']);
});

// admin

// camaba
Route::view('camaba-beastudi', 'camaba-beastudi')->name('camaba-beastudi');

// mahasiswa
Route::middleware('auth:mahasiswa')
    ->as('mahasiswa.')
    ->group(function() {
        Route::get('/', DashboardController::class)->name('dashboard');

        Route::view('/data-diri', 'mahasiswa.data-diri')->name('data-diri');
        Route::view('/laporan-semester', 'mahasiswa.monitoring')->name('monitoring');

        Route::post('logout', LogoutController::class)->name('logout');
    });
