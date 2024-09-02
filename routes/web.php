<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\LogoutController as AdminLogoutController;
use App\Http\Controllers\CamabaController;
use App\Models\Monitoring;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mahasiswa\LoginController as MahasiswaLoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Mahasiswa\MouController;
use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\Mahasiswa\DataDiriController;
use App\Http\Controllers\Mahasiswa\LogoutController;
use App\Http\Controllers\Mahasiswa\MonitoringController;
use App\Http\Livewire\Admin\ShowMasterData;
use App\Http\Livewire\Admin\ShowMonitoring;
use App\Http\Livewire\Mahasiswa\ShowMou;

Route::view('pdf', 'pdf');
Route::view('lpj', 'lpj');

Route::get('p', function() {
    return env('APP_ENV');
});

Route::get('kabupaten', KabupatenController::class);
Route::get('kecamatan', KecamatanController::class);
Route::get('kelurahan', KelurahanController::class);

// auth
Route::middleware('guest:web,mahasiswa')->group(function() {
    Route::get('register', [RegisterController::class, 'index']);
    Route::post('register', [RegisterController::class, 'store']);

    Route::get('mahasiswa-beastudi', [MahasiswaLoginController::class, 'index'])->name('login');
    Route::post('mahasiswa-beastudi', [MahasiswaLoginController::class, 'store']);

    Route::get('admin-login', [AdminLoginController::class, 'index'])->name('admin.login');
    Route::post('admin-login', [AdminLoginController::class, 'store']);
});

// admin
Route::middleware('auth')
    ->prefix('admin')
    ->as('admin.')
    ->group(function() {
        Route::get('dashboard', AdminDashboardController::class)->name('dashboard');

        Route::view('master-data', 'admin.master-data')->name('master-data');
        Route::get('master-data/{nim}/mahasiswa', ShowMasterData::class)->name('master-data.show');

        Route::get('monitoring/{nim}/mahasiswa', ShowMonitoring::class)->name('monitoring.show');

        Route::view('redaksi', 'admin.redaksi')->name('redaksi');

        // Route::view('periode', 'admin.periode')->name('periode');
        // Route::view('jalur-beastudi', 'admin.jalur-beastudi')->name('jalur-beastudi');
        Route::view('kontribusi-khusus', 'admin.kontribusi-khusus')->name('kontribusi-khusus');

        Route::post('logout', AdminLogoutController::class)->name('logout');
    });

// camaba
Route::view('camaba-beastudi', 'camaba-beastudi')->name('camaba-beastudi');

// mahasiswa
Route::middleware('auth:mahasiswa')
    ->as('mahasiswa.')
    ->group(function() {
        Route::get('/', DashboardController::class)->name('dashboard');

        Route::view('data-diri', 'mahasiswa.data-diri')->name('data-diri');
        Route::view('laporan-semester', 'mahasiswa.monitoring')->name('monitoring');

        Route::post('logout', LogoutController::class)->name('logout');
    });
