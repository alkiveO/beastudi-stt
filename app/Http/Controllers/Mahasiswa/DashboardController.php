<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Monitoring;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();

        $statusMap = [0 => 'Tidak Aktif', 1 => 'Aktif', 2 => 'Keluar'];
        $StatusMHS = $statusMap[$user->status] ?? 'Tidak Diketahui';

        $hasFilledForm = Monitoring::where('nim', $user->nim)->exists();
        $alertType = $hasFilledForm ? 'success' : 'danger';
        $StatusForm = $hasFilledForm
            ? "Anda sudah mengisi form performa pada semester ini."
            : "Anda belum mengisi form performa pada semester ini.";

        return view('mahasiswa.dashboard', compact('StatusMHS', 'StatusForm', 'alertType'));
    }
}
