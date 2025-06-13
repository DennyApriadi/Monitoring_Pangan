<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokPangan;
use App\Models\Lokasi;
use App\Models\JenisPangan;

use Barryvdh\DomPDF\Facade\Pdf as PDF;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Memanggil relasi 'lokasi' dan 'pangan'
        $query = StokPangan::with(['lokasi', 'pangan']); // Menggunakan 'pangan' untuk relasi yang benar

        if ($request->lokasi_id) {
            $query->where('lokasi_id', $request->lokasi_id);
        }

        if ($request->pangan_id) {
            $query->where('pangan_id', $request->pangan_id);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $data = $query->latest()->paginate(10);
        $lokasi = Lokasi::all();
        $jenis = JenisPangan::all();

        return view('laporan.index', compact('data', 'lokasi', 'jenis'));
    }

    public function export(Request $request)
    {
        $query = StokPangan::with(['lokasi', 'pangan']); // Menggunakan 'pangan' untuk relasi yang benar

        if ($request->lokasi_id) {
            $query->where('lokasi_id', $request->lokasi_id);
        }

        if ($request->pangan_id) {
            $query->where('pangan_id', $request->pangan_id);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $data = $query->latest()->get();

        $pdf = PDF::loadView('laporan.pdf', compact('data'))->setPaper('a4', 'landscape');
        return $pdf->download('laporan-ketersediaan-pangan.pdf');

    }

    public function exportExcel(Request $request)
{
    $query = StokPangan::with(['lokasi', 'pangan']);

    if ($request->lokasi_id) {
        $query->where('lokasi_id', $request->lokasi_id);
    }

    if ($request->pangan_id) {
        $query->where('pangan_id', $request->pangan_id);
    }

    if ($request->status) {
        $query->where('status', $request->status);
    }

    $data = $query->latest()->get();

    return Excel::download(new \App\Exports\LaporanExport($data), 'laporan-ketersediaan-pangan.xlsx');
    }
}
