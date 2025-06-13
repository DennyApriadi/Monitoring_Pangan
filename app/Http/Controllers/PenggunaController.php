<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    /**
     * Display the Pengguna dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Return the view for Pengguna dashboard
        return view('stok.dashboard');
    }
}
