<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Redaksi;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $redaksi_login_page = Redaksi::query()
            ->where('jenis', 'login page mahasiswa')
            ->first();

        return view('mahasiswa.login', compact('redaksi_login_page'));
    }

    public function store()
    {
        $mahasiswa = Mahasiswa::query()
            ->where('email', request()->email)
            ->where('nim', request()->password)
            ->first();

        if ($mahasiswa) {
            Auth::guard('mahasiswa')->login($mahasiswa);

            return redirect()->intended(route('mahasiswa.dashboard'));
        }

        return back()->with(['error' => 'Akun mahasiswa beastudi tidak ditemukan']);
    }
}
