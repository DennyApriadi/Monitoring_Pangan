<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // di sini bisa kirim data khusus admin nanti
        return view('admin.dashboard');
    }
}
