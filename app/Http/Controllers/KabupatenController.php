<?php

namespace App\Http\Controllers;

use App\Models\Province;

class KabupatenController extends Controller
{
    public function __invoke()
    {
        $province = Province::find(request()->province_id);

        return response()->json($province->regencies);
    }
}
