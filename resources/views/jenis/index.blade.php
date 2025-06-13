@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-0">
                <i class="bi bi-box-fill text-primary me-2"></i> Data Jenis Pangan
            </h3>
            <p class="text-muted mb-0">Kelola berbagai jenis pangan yang tersedia.</p>
        </div>
        <a href="{{ route('jenis.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Jenis
        </a>
    </div>

    <!-- Notifikasi -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Tabel Jenis Pangan -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 70%;">
                            <i class="bi bi-basket-fill me-1 text-secondary"></i> Nama Jenis Pangan
                        </th>
                        <th style="width: 30%;" class="text-end">
                            <i class="bi bi-gear-fill me-1 text-secondary"></i> Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jenis as $j)
                        <tr>
                            <td>{{ $j->nama_pangan }}</td>
                            <td class="text-end">
                                <a href="{{ route('jenis.edit', $j->id) }}" class="btn btn-sm btn-warning me-1">
                                    <i class="bi bi-pencil-fill"></i> Edit
                                </a>
                                <form action="{{ route('jenis.destroy', $j->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash-fill"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center text-muted py-4">
                                <i class="bi bi-info-circle"></i> Belum ada data jenis pangan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if ($jenis instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="d-flex justify-content-center mt-3">
                    {{ $jenis->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
