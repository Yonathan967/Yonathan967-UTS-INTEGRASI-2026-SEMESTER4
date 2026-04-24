<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function index()
    {
        return view('halaman_auth/login');
    }

    public function login(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required|min:8'
    ], [
        'username.required' => 'Username wajib diisi',
        'password.required' => 'Password wajib diisi',
        'password.min' => 'Password minimal 8 karakter'
    ]);

    // 🔥 INI YANG BENAR (bukan $credentials, tapi harus ini)
    $credentials = [
        'username' => $request->username,
        'password' => $request->password
    ];

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        if (Auth::user()->role == 'admin') {
            return redirect('/poinakses/admin/dashboard');
        }

        return redirect('/poinakses/user/dashboard');
    }

    return back()->withErrors([
        'login' => 'Username atau password salah'
    ]);
}

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}