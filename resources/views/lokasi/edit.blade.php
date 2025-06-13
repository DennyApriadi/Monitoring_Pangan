@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h3 class="mb-0">✏️ Edit Lokasi</h3>
        <p class="text-muted">Perbarui data lokasi sesuai kebutuhan.</p>
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
            <form action="{{ route('lokasi.update', $lokasi->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_lokasi" class="form-label">📍 Nama Lokasi</label>
                    <input type="text" name="nama_lokasi" id="nama_lokasi" value="{{ old('nama_lokasi', $lokasi->nama_lokasi) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="provinsi" class="form-label">🗺️ Provinsi</label>
                    <input type="text" name="provinsi" id="provinsi" value="{{ old('provinsi', $lokasi->provinsi) }}" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label for="kota" class="form-label">🏙️ Kota</label>
                    <input type="text" name="kota" id="kota" value="{{ old('kota', $lokasi->kota) }}" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">🔙 Kembali</a>
                    <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
