<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisPangan;

class JenisPanganController extends Controller
{
    // Menampilkan daftar jenis pangan
public function index()
{
    $jenis = JenisPangan::paginate(10); // Tambahkan ini
    return view('jenis.index', compact('jenis'));
}

// Menampilkan form untuk menambah jenis pangan
public function create()
{
    return view('jenis.create');
}

// Menyimpan jenis pangan baru
public function store(Request $request)
{
    $request->validate([
        'nama_pangan' => 'required|string|max:255',
        'satuan' => 'required|string|max:50',
    ]);

    JenisPangan::create([
        'nama_pangan' => $request->nama_pangan,
        'satuan' => $request->satuan,
    ]);

    return redirect()->route('jenis.index')->with('success', 'Jenis pangan berhasil ditambahkan.');
}

// Menampilkan form untuk mengedit jenis pangan
public function edit($id)
{
    $jenis = JenisPangan::findOrFail($id);
    return view('jenis.edit', compact('jenis'));
}

// Mengupdate jenis pangan
public function update(Request $request, $id)
{
    $request->validate([
        'nama_pangan' => 'required|string|max:255',
        'satuan' => 'required|string|max:50',
    ]);

    $jenis = JenisPangan::findOrFail($id);
    $jenis->update([
        'nama_pangan' => $request->nama_pangan,
        'satuan' => $request->satuan,
    ]);

    return redirect()->route('jenis.index')->with('success', 'Jenis pangan berhasil diperbarui.');
}


// Menghapus jenis pangan
public function destroy($id)
{
    $jenis = JenisPangan::findOrFail($id);
    $jenis->delete();

    return redirect()->route('jenis.index')->with('success', 'Jenis pangan berhasil dihapus.');
}


}
