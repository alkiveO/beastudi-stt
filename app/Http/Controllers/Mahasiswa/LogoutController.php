<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function __invoke()
    {
        auth()->guard('mahasiswa')->logout();

        return redirect('mahasiswa/login');
    }
}
