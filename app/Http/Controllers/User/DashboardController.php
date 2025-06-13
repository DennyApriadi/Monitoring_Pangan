<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // di sini bisa kirim data khusus pengguna nanti
        return view('user.dashboard');
    }
}
