<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        if (!$user) {
            return redirect('/');
        }

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'kemas' => redirect()->route('kemas.dashboard'),
            'pa' => redirect()->route('pa.dashboard'),
            default => redirect('/'),
        };
    }
}