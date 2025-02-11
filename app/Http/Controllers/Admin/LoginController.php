<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function store()
    {
        $user = User::query()
            ->where('email', request()->email)
            ->first();

        if ($user && $user->isAdmin() && Hash::check(request()->password, $user->password)) {
            Auth::guard('web')->login($user);

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->with(['error' => 'Email atau password salah']);
    }
}
