<?php

namespace App\Http\Controllers;

use App\Models\District;

class KelurahanController extends Controller
{
    public function __invoke()
    {
        $district = District::find(request()->district_id);

        return response()->json($district->villages);
    }
}
