@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-0">
                <i class="bi bi-geo-alt-fill text-primary me-2"></i> Daftar Lokasi
            </h3>
            <p class="text-muted mb-0">Kelola informasi lokasi penyimpanan data pangan.</p>
        </div>
        <a href="{{ route('lokasi.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Lokasi
        </a>
    </div>

    <!-- Form Pencarian -->
    <form action="{{ route('lokasi.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari nama lokasi / kota / provinsi..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">
                <i class="bi bi-search"></i> Cari
            </button>
            @if(request('search'))
                <a href="{{ route('lokasi.index') }}" class="btn btn-outline-danger">
                    <i class="bi bi-x-circle"></i> Reset
                </a>
            @endif
        </div>
    </form>

    <!-- Notifikasi -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Tabel Lokasi -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 30%;"><i class="bi bi-tag-fill me-1 text-secondary"></i> Nama Lokasi</th>
                        <th style="width: 40%;"><i class="bi bi-map-fill me-1 text-secondary"></i> Alamat</th>
                        <th style="width: 30%;"><i class="bi bi-gear-fill me-1 text-secondary"></i> Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lokasi as $l)
                        <tr>
                            <td>{{ $l->nama_lokasi }}</td>
                            <td>{{ $l->kota }}, {{ $l->provinsi }}</td>
                            <td>
                                <a href="{{ route('lokasi.edit', $l->id) }}" class="btn btn-sm btn-warning me-1">
                                    <i class="bi bi-pencil-fill"></i> Edit
                                </a>
                                <form action="{{ route('lokasi.destroy', $l->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash-fill"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">
                                <i class="bi bi-info-circle me-1"></i> Belum ada data lokasi yang sesuai.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Ringkasan dan Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $lokasi->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
