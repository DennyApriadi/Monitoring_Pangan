<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function create()
{
    return view('lokasi.create');
}

    // Menampilkan semua data lokasi
    public function index(Request $request)
{
    $query = \App\Models\Lokasi::query();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where('nama_lokasi', 'like', "%$search%")
              ->orWhere('kota', 'like', "%$search%")
              ->orWhere('provinsi', 'like', "%$search%");
    }

    $lokasi = $query->latest()->paginate(10); // Gunakan paginate()

    return view('lokasi.index', compact('lokasi'));
}


    // Menyimpan data lokasi baru
    public function store(Request $request)
{
    $request->validate([
        'nama_lokasi' => 'required|string|max:255',
        'provinsi' => 'required|string|max:255',
        'kota' => 'required|string|max:255',
    ]);

    Lokasi::create([
        'nama_lokasi' => $request->nama_lokasi,
        'provinsi' => $request->provinsi,
        'kota' => $request->kota,
    ]);

    return redirect()->route('lokasi.index')->with('success', 'Lokasi berhasil ditambahkan.');
}


    // Menampilkan form edit
    public function edit($id)
{
    $lokasi = Lokasi::findOrFail($id);
    return view('lokasi.edit', compact('lokasi'));
}

    // Mengupdate data lokasi
    public function update(Request $request, $id)
{
    $request->validate([
        'nama_lokasi' => 'required|string|max:255',
        'provinsi' => 'required|string|max:255',
        'kota' => 'required|string|max:255',
    ]);

    $lokasi = Lokasi::findOrFail($id);
    $lokasi->update([
        'nama_lokasi' => $request->nama_lokasi,
        'provinsi' => $request->provinsi,
        'kota' => $request->kota,
    ]);

    return redirect()->route('lokasi.index')->with('success', 'Lokasi berhasil diupdate.');
}


    // Menghapus data lokasi
    public function destroy(Lokasi $lokasi)
    {
        $lokasi->delete();
        return redirect()->route('lokasi.index')->with('success', 'Data lokasi berhasil dihapus.');
    }
}
