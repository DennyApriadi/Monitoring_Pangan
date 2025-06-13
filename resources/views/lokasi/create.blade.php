@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h3 class="mb-0">➕ Tambah Lokasi Baru</h3>
        <p class="text-muted">Silakan isi data lokasi secara lengkap.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong>
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('lokasi.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nama_lokasi" class="form-label">📍 Nama Lokasi</label>
                    <input type="text" name="nama_lokasi" id="nama_lokasi" class="form-control" placeholder="Contoh: Gudang Utama" required>
                </div>

                <div class="mb-3">
                    <label for="provinsi" class="form-label">🗺️ Provinsi</label>
                    <input type="text" name="provinsi" id="provinsi" class="form-control" placeholder="Contoh: Jawa Barat" required>
                </div>

                <div class="mb-4">
                    <label for="kota" class="form-label">🏙️ Kota</label>
                    <input type="text" name="kota" id="kota" class="form-control" placeholder="Contoh: Bandung" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">🔙 Kembali</a>
                    <button type="submit" class="btn btn-success">💾 Simpan Lokasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
