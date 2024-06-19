<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;

class MouController extends Controller
{
    public function __invoke()
    {
        return view('mahasiswa.mou');
    }
}
