@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm mx-auto" style="max-width: 600px;">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">➕ Tambah Jenis Pangan</h5>
            <a href="{{ route('jenis.index') }}" class="btn btn-outline-light btn-sm">
                <i class="bi bi-arrow-left-circle"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('jenis.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="nama_pangan" class="form-label">Nama Jenis Pangan</label>
                    <input type="text" id="nama_pangan" name="nama_pangan"
                           class="form-control @error('nama_pangan') is-invalid @enderror"
                           placeholder="Contoh: Beras, Jagung"
                           value="{{ old('nama_pangan') }}" required>
                    @error('nama_pangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="satuan" class="form-label">Satuan</label>
                    <input type="text" id="satuan" name="satuan"
                           class="form-control @error('satuan') is-invalid @enderror"
                           placeholder="Contoh: Kg, Liter"
                           value="{{ old('satuan') }}" required>
                    @error('satuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
