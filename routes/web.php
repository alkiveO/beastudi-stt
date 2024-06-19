<?php

use App\Models\Monitoring;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mahasiswa\LoginController as MahasiswaLoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Mahasiswa\MouController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Mahasiswa\LogoutController;
use App\Http\Controllers\Mahasiswa\MabaController;
use App\Http\Controllers\Mahasiswa\MonitoringController;
use App\Http\Livewire\Mahasiswa\ShowMou;

Route::middleware('guest:web,mahasiswa')->group(function() {
    Route::get('register', [RegisterController::class, 'index']);
    Route::post('register', [RegisterController::class, 'store']);

    Route::get('mahasiswa/login', [MahasiswaLoginController::class, 'index'])->name('login');
    Route::post('mahasiswa/login', [MahasiswaLoginController::class, 'store']);
});

// admin

// pic

// mahasiswa
Route::middleware('auth:mahasiswa')
    ->as('mahasiswa.')
    ->group(function() {
        Route::get('/', DashboardController::class)->name('dashboard');

        Route::get('/mou', MouController::class)->name('mou.index');
        // Route::get('/mou/{mou:nim}', ShowMou::class)->name('mou.show');

        Route::get('/maba', MabaController::class)->name('maba');

        Route::get('/monitoring', MonitoringController::class)->name('monitoring');

        Route::post('logout', LogoutController::class)->name('logout');
    });
