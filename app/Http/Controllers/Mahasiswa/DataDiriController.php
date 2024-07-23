<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;

class DataDiriController extends Controller
{
    public function __invoke()
    {
        return view('mahasiswa.data-diri');
    }
}
