<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class MonitoringController extends Controller
{
    public function __invoke()
    {
        return view('mahasiswa.monitoring');
    }
}
