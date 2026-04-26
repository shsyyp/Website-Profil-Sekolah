<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // 2. Ambil credential
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        // 3. Proses autentikasi
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            // PERBAIKAN DI SINI: Gunakan route('dashboard') agar dinamis ke /admin/dashboard
            return redirect()->intended(route('dashboard'));
        }

        // 4. Jika gagal
        return back()->with('error', 'Email atau password salah!')->withInput($request->only('email'));
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