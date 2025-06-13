<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

  // Fungsi registrasi pengguna baru
public function register(Request $request)
{
    // Validasi input
    $request->validate([
        'name'     => 'required|string|max:100',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:6',
    ]);

    // Membuat user baru
    $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'role'     => 'pengguna',  // Default role pengguna
    ]);

    // Login otomatis setelah registrasi
    Auth::login($user);

    // Arahkan pengguna berdasarkan role
    if ($user->role === 'admin') {
        return redirect()->route('stok.index'); // Jika admin, arahkan ke stok (admin dashboard)
    } else {
        return redirect()->route('stok.dashboard'); // Jika pengguna biasa, arahkan ke halaman pengguna
    }
}


    // Fungsi login untuk pengguna dan admin dengan satu tombol
    public function login(Request $request)
    {
        // Validasi input login
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // Coba autentikasi menggunakan kredensial
        if (Auth::attempt($credentials)) {
            // Regenerasi session setelah login
            $request->session()->regenerate();

            // Cek role pengguna dan arahkan ke halaman yang sesuai
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->role === 'pengguna') {
                return redirect()->route('stok.dashboard');
            }

            // Jika role tidak dikenali
            Auth::logout();
            return back()->with('error', 'Role tidak dikenali, logout untuk melanjutkan.');
        }

        // Jika autentikasi gagal
        return back()->with('error', 'Email atau password salah.');
    }

    // Fungsi logout
    public function logout(Request $request)
    {
        // Logout pengguna dan hapus session
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman home dengan pesan sukses
        return redirect()->route('home')->with('success', 'Berhasil logout!');
    }
}
