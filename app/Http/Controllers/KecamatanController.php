<?php

namespace App\Http\Controllers;

use App\Models\Regency;

class KecamatanController extends Controller
{
    public function __invoke()
    {
        $regency = Regency::find(request()->regency_id);

        return response()->json($regency->districts);
    }
}
