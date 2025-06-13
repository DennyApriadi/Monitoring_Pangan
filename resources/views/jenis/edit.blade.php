@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h3>Edit Jenis Pangan</h3>

            <!-- Menampilkan pesan sukses jika ada -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('jenis.update', $jenis->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_pangan" class="form-label">Nama Jenis Pangan</label>
                    <input type="text" name="nama_pangan" id="nama_pangan" value="{{ old('nama_pangan', $jenis->nama_pangan) }}" class="form-control @error('nama_pangan') is-invalid @enderror" required>
                    @error('nama_pangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="satuan" class="form-label">Satuan</label>
                    <input type="text" name="satuan" id="satuan" value="{{ old('satuan', $jenis->satuan) }}" class="form-control @error('satuan') is-invalid @enderror" required>
                    @error('satuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('jenis.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection
