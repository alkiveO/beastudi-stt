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
        $credentials = request()->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return back()->with(['error' => 'Email atau password salah']);
        }

        Auth::guard('web')->login($user);

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'kemas') {
            return redirect()->route('kemas.dashboard');
        }

        if ($user->role === 'pa') {
            return redirect()->route('pa.dashboard');
        }

        Auth::guard('web')->logout();

        return back()->with(['error' => 'Role tidak diizinkan']);
    }
}