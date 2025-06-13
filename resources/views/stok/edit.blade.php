@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="mb-4">
                <i class="bi bi-pencil-square text-warning me-2"></i> Edit Stok Pangan
            </h4>

            <!-- Menampilkan pesan error jika ada -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong><i class="bi bi-exclamation-circle-fill me-1"></i>Terjadi kesalahan:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Edit -->
            <form action="{{ route('stok.update', $stok->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Lokasi -->
                <div class="mb-3">
                    <label for="lokasi_id" class="form-label">Lokasi</label>
                    <select name="lokasi_id" id="lokasi_id" class="form-select" required>
                        @foreach ($lokasi as $l)
                            <option value="{{ $l->id }}" {{ $stok->lokasi_id == $l->id ? 'selected' : '' }}>
                                {{ $l->nama_lokasi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Jenis Pangan -->
                <div class="mb-3">
                    <label for="pangan_id" class="form-label">Jenis Pangan</label>
                    <select name="pangan_id" id="pangan_id" class="form-select" required>
                        @foreach ($pangan as $p)
                            <option value="{{ $p->id }}" {{ $stok->pangan_id == $p->id ? 'selected' : '' }}>
                                {{ $p->nama_pangan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Jumlah Stok -->
                <div class="mb-3">
                    <label for="jumlah_stok" class="form-label">Jumlah Stok</label>
                    <input type="number" name="jumlah_stok" id="jumlah_stok" class="form-control" value="{{ $stok->jumlah_stok }}" required>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="Aman" {{ $stok->status == 'Aman' ? 'selected' : '' }}>Aman</option>
                        <option value="Waspada" {{ $stok->status == 'Waspada' ? 'selected' : '' }}>Waspada</option>
                        <option value="Kritikal" {{ $stok->status == 'Kritikal' ? 'selected' : '' }}>Kritikal</option>
                    </select>
                </div>

                <!-- Tanggal Input -->
                <div class="mb-3">
                    <label for="tanggal_input" class="form-label">Tanggal Input</label>
                    <input type="date" name="tanggal_input" id="tanggal_input" class="form-control" value="{{ $stok->tanggal_input }}" required>
                </div>

                <!-- Tombol Kembali dan Update -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('stok.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-save2 me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
