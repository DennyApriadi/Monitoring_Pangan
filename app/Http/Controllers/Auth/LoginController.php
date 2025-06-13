<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Tempat redirect default jika tidak ditangani di authenticated()
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect pengguna berdasarkan role setelah login berhasil.
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('stok.index'); // Admin ke halaman stok
        } elseif ($user->role === 'user') {
            return redirect()->route('laporan.index'); // User ke halaman laporan
        }

        return redirect('/'); // Default fallback
    }
}
