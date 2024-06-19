<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class MabaController extends Controller
{
    public function __invoke()
    {
        return view('mahasiswa.maba');
    }
}
