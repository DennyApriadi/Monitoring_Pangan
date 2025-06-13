<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\StokPanganController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\JenisPanganController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PenggunaController;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
*/

// Home Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ========================
// Guest-only (belum login)
// ========================
Route::middleware('guest')->group(function () {

    // Halaman Register
    Route::get('/register', fn() => view('auth.register'))->name('register');
    Route::post('/register', function (Request $request) {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'pengguna', // Default pengguna
        ]);

        Auth::login($user);
        session(['user' => [
            'name' => $user->name,
            'role' => 'pengguna',
        ]]);

        return redirect()->route('stok.index');
    });

    // Halaman Login
    Route::get('/login', fn() => view('auth.login'))->name('login');
    Route::post('/login', function (Request $request) {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            session(['user' => [
                'name' => $user->name,
                'role' => $user->role,
            ]]);
            return redirect()->intended(route('laporan.index'));
        }

        return back()->withErrors(['email' => 'Email atau password salah'])->onlyInput('email');
    });

    // Form Login Pengguna (GET)
    Route::get('/login/pengguna', function () {
        return view('auth.login_pengguna');
    })->name('login.pengguna.view');

    // Proses Login Pengguna (POST)
    Route::post('/login/pengguna', [AuthController::class, 'loginPengguna'])
        ->name('login.pengguna');
});

// Halaman Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin-panel', [AdminController::class, 'index']);


});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});

// ========================
// Authenticated-only (sudah login)
// ========================
Route::middleware('auth')->group(function () {


    Route::get('/pengguna/dashboard', [PenggunaController::class, 'index'])->name('pengguna.dashboard');

    // Logout (berlaku untuk Auth + session)
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Berhasil logout.');
    })->name('logout');

    // ========================
    // Admin-only routes
    // ========================
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    });

    // ========================
    // Semua role (admin & pengguna biasa)
    // ========================

    // Dashboard Stok
    Route::get('/stok/dashboard', [StokPanganController::class, 'dashboard'])->name('stok.dashboard');

    // CRUD Stok Pangan
    Route::resource('stok', StokPanganController::class);

    // CRUD Lokasi
    Route::resource('lokasi', LokasiController::class)->except(['update']);
    Route::put('/lokasi/{id}', [LokasiController::class, 'update'])->name('lokasi.update');

    // CRUD Jenis Pangan
    Route::resource('jenis', JenisPanganController::class);

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');
    Route::get('/laporan/export-excel', [LaporanController::class, 'exportExcel'])->name('laporan.export.excel');
});
