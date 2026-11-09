<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class PasswordResetController extends Controller
{
    /**
     * Menampilkan halaman permintaan reset password.
     */
    public function showLinkRequestForm()
    {
        return view('mahasiswa.password.email');
    }

    /**
     * Mengirim tautan reset password ke email mahasiswa.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $mahasiswa = Mahasiswa::query()
            ->where('email', $request->email)
            ->where('status', true)
            ->first();

        if ($mahasiswa) {
            Password::broker('mahasiswa')->sendResetLink([
                'email' => $request->email,
            ]);
        }

        return back()->with(
            'status',
            'Jika email terdaftar pada akun mahasiswa aktif, tautan reset password akan dikirim.'
        );
    }

    /**
     * Menampilkan halaman untuk membuat password baru.
     */
    public function showResetForm(Request $request, string $token)
    {
        return view('mahasiswa.password.reset', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    /**
     * Memproses password baru mahasiswa.
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $mahasiswa = Mahasiswa::query()
            ->where('email', $request->email)
            ->where('status', true)
            ->first();

        if (!$mahasiswa) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => __(Password::INVALID_USER),
                ]);
        }

        $status = Password::broker('mahasiswa')->reset(
            $request->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            ),
            function (Mahasiswa $mahasiswa, string $password) {
                $mahasiswa->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                event(new PasswordReset($mahasiswa));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()
                ->route('mahasiswa.login')
                ->with('success', 'Password berhasil diperbarui. Silakan login.');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => __($status),
            ]);
    }
}