<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        // Jika sudah login, lempar langsung ke dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    // Memproses data login
    public function login(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required'
        ]);

        // 2. Cari user dari email, nama, atau bagian awal email sebagai username.
        $login = trim((string) $request->input('email'));
        $user = User::query()
            ->where('email', $login)
            ->orWhere('username', $login)
            ->orWhere('name', $login)
            ->when(! str_contains($login, '@'), function ($query) use ($login) {
                $query->orWhere('email', 'like', $login . '@%');
            })
            ->first();

        $remember = $request->has('remember');

        // 3. Proses autentikasi
        if ($user && Hash::check((string) $request->input('password'), $user->password)) {
            Auth::login($user, $remember);
            $request->session()->regenerate();
            
            // PERBAIKAN DI SINI: Gunakan route('dashboard') agar dinamis ke /admin/dashboard
            return redirect()->intended(route('dashboard'));
        }

        // 4. Jika gagal
        return back()->with('error', 'Email, username, atau password salah!')->withInput($request->only('email'));
    }

    // Memproses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
