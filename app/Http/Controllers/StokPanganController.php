<?php

namespace App\Http\Controllers;

use App\Models\StokPangan;
use App\Models\Lokasi;
use App\Models\JenisPangan;
use Illuminate\Http\Request;

use App\Models\Stok;

class StokPanganController extends Controller
{
    // Menambahkan middleware untuk memastikan pengguna login
    public function __construct()
    {
        $this->middleware('auth');  // Middleware 'auth' memastikan hanya pengguna yang login yang bisa mengakses
    }
    public function dashboard()
{
    $stok = StokPangan::with(['lokasi', 'pangan'])->get();

    // Group data untuk stok berdasarkan jenis pangan, status, tanggal, dan lokasi
    $stokByPangan = $stok->groupBy('pangan.nama_pangan')->map(fn($items) => $items->sum('jumlah_stok'));
    $stokStatus = $stok->groupBy('status')->map(fn($items) => $items->count());
    $stokPerTanggal = $stok->groupBy('tanggal_input')->map(fn($items) => $items->sum('jumlah_stok'))->sortKeys();
    $stokPerLokasi = $stok->groupBy('lokasi.nama_lokasi')->map(fn($items) => $items->sum('jumlah_stok'));

    return view('stok.dashboard', compact('stokByPangan', 'stokStatus', 'stokPerTanggal', 'stokPerLokasi'));
}
/**
     * Menampilkan daftar stok pangan.
     */
    public function index()
    {
        // Mengambil semua data StokPangan beserta relasi dengan Lokasi dan JenisPangan
        $stok = StokPangan::with(['lokasi', 'pangan'])->paginate(10); // 10 data per halaman
        // Group by jenis pangan
    $stokByPangan = $stok->groupBy('pangan.nama_pangan')->map(function ($items) {
        return $items->sum('jumlah_stok');
    });

    return view('stok.index', [
        'stok' => $stok,
        'stokByPangan' => $stokByPangan,
    ]);
    }

    /**
     * Menampilkan formulir untuk membuat stok pangan baru.
     */
    public function create()
    {
        // Mengambil data Lokasi dan JenisPangan untuk ditampilkan di formulir
        $lokasi = Lokasi::all();
        $pangan = JenisPangan::all();
        return view('stok.create', compact('lokasi', 'pangan'));
    }

    /**
     * Menyimpan stok pangan baru ke dalam database.
     */
    public function store(Request $request)
    {
        // Memvalidasi data yang diterima dari formulir
        $request->validate([
            'lokasi_id' => 'required|exists:lokasis,id',
            'pangan_id' => 'required|exists:jenis_pangans,id',
            'jumlah_stok' => 'required|numeric',
            'status' => 'required|in:Aman,Waspada,Kritikal',
            'tanggal_input' => 'required|date',

        ]);

        // Menyimpan data stok pangan ke dalam database
        StokPangan::create($request->all());

        // Redirect ke halaman daftar stok dengan pesan sukses
        return redirect()->route('stok.index')->with('success', 'Stok Pangan berhasil dibuat!');
    }

    /**
     * Menampilkan detail stok pangan yang dipilih.
     */
    public function show(StokPangan $stokPangan)
    {
        // Menampilkan detail dari stok pangan tertentu
        return view('stok.show', compact('stokPangan'));
    }

    /**
     * Menampilkan formulir untuk mengedit stok pangan yang sudah ada.
     */
    public function edit($id)
{
    // Ambil data stok berdasarkan ID
    $stok = StokPangan::findOrFail($id);

    // Ambil data lokasi dan jenis pangan untuk dropdown
    $lokasi = Lokasi::all(); // Ambil semua data lokasi
    $pangan = JenisPangan::all(); // Ambil semua data jenis pangan

    // Kembalikan ke view dengan data stok, lokasi, dan pangan
    return view('stok.edit', compact('stok', 'lokasi', 'pangan'));
}



    /**
     * Memperbarui stok pangan yang sudah ada di database.
     */
    public function update(Request $request, StokPangan $stok)
{
    // Validasi input
    $request->validate([
        'lokasi_id' => 'required|exists:lokasis,id',
        'pangan_id' => 'required|exists:jenis_pangans,id',
        'jumlah_stok' => 'required|numeric',
        'status' => 'required|in:Aman,Waspada,Kritikal',
        'tanggal_input' => 'required|date',
    ]);

    // Update data
    $stok->update($request->all());

    return redirect()->route('stok.index')->with('success','Berhasil update stok');
}

public function destroy(StokPangan $stok)
{
    $stok->delete();
    return redirect()->route('stok.index')->with('success','Berhasil hapus stok');
}

}

