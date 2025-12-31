<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DownloadLpjController;
use App\Http\Controllers\Admin\DownloadSpbController;
use App\Http\Controllers\Admin\MahasiswaExportController;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\LogoutController as AdminLogoutController;
use App\Http\Controllers\CamabaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mahasiswa\LoginController as MahasiswaLoginController;
use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\Mahasiswa\DataDiriController;
use App\Http\Controllers\Mahasiswa\LogoutController;
use App\Http\Controllers\Mahasiswa\MonitoringController;
use App\Http\Livewire\Admin\ListPembimbingAkademik;
use App\Http\Livewire\Admin\PengaturanMonitoring;
use App\Http\Livewire\Admin\ListWilayah;
use App\Http\Livewire\Admin\ShowMasterData;
use App\Http\Livewire\Admin\ShowMonitoring;

Route::get('kabupaten', KabupatenController::class);
Route::get('kecamatan', KecamatanController::class);
Route::get('kelurahan', KelurahanController::class);



// auth
Route::middleware('guest:web,mahasiswa')->group(function() {
    // Route::get('register', [RegisterController::class, 'index']);
    // Route::post('register', [RegisterController::class, 'store']);

    Route::get('mahasiswa-login', [MahasiswaLoginController::class, 'index'])->name('mahasiswa.login');
    Route::post('mahasiswa-login', [MahasiswaLoginController::class, 'store']);

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
        Route::get('master-data/{mhs_id}/mahasiswa', ShowMasterData::class)->name('master-data.show');
        Route::get('master-data/export-data-mahasiswa', MahasiswaExportController::class)->name('index');

        Route::get('monitoring/{nim}/mahasiswa', ShowMonitoring::class)->name('monitoring.show');

        Route::get('download-spb', DownloadSpbController::class)->name('download-spb');
        Route::get('download-lpj', DownloadLpjController::class)->name('download-lpj');

        Route::view('monitoring', 'admin.monitoring')->name('monitoring');
        Route::view('redaksi', 'admin.redaksi')->name('redaksi');
        Route::view('prestasi', 'admin.prestasi')->name('prestasi');

        Route::view('periode', 'admin.periode')->name('periode');
        Route::view('jalur-beastudi', 'admin.jalur-beastudi')->name('jalur-beastudi');
        Route::view('kontribusi-khusus', 'admin.kontribusi-khusus')->name('kontribusi-khusus');
        Route::get('wilayah', ListWilayah::class)->name('wilayah');
        Route::get('pembimbing-akademik', ListPembimbingAkademik::class)->name('pembimbing-akademik');
 Route::view(
            'pengaturan-monitoring',
            'admin.pengMonitoring'
        )->name('pengaturan-monitoring');
        Route::post('logout', AdminLogoutController::class)->name('logout');
    });

// camaba
Route::view('camaba-beastudi', 'camaba-beastudi')->name('camaba-beastudi');

// mahasiswa
Route::middleware('auth:mahasiswa')
    ->as('mahasiswa.')
    ->group(function() {
        // Route::get('/', DashboardController::class)->name('dashboard');
        Route::view('/', 'mahasiswa.dashboard')->name('dashboard');

        Route::view('data-diri', 'mahasiswa.data-diri')->name('data-diri');
        Route::view('laporan-semester', 'mahasiswa.monitoring')->name('monitoring');

        Route::post('logout', LogoutController::class)->name('logout');
    });
