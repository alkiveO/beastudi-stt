<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function __invoke()
    {
        auth()->guard('web')->logout();

        return redirect('admin-login');
    }
}
