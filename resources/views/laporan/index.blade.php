@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">
        <i class="bi bi-file-earmark-bar-graph me-2"></i> Laporan Ketersediaan Pangan
    </h3>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('laporan.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label">Lokasi</label>
                        <select name="lokasi_id" class="form-select">
                            <option value="">Pilih Lokasi</option>
                            @foreach ($lokasi as $l)
                                <option value="{{ $l->id }}" {{ request('lokasi_id') == $l->id ? 'selected' : '' }}>
                                    {{ $l->nama_lokasi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Jenis Pangan</label>
                        <select name="pangan_id" class="form-select">
                            <option value="">Pilih Jenis Pangan</option>
                            @foreach ($jenis as $j)
                                <option value="{{ $j->id }}" {{ request('pangan_id') == $j->id ? 'selected' : '' }}>
                                    {{ $j->nama_pangan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Pilih Status</option>
                            <option value="Aman" {{ request('status') == 'Aman' ? 'selected' : '' }}>Aman</option>
                            <option value="Waspada" {{ request('status') == 'Waspada' ? 'selected' : '' }}>Waspada</option>
                            <option value="Kritikal" {{ request('status') == 'Kritikal' ? 'selected' : '' }}>Kritikal</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-funnel-fill me-1"></i> Filter
                        </button>
                        <a href="{{ route('laporan.export', request()->query()) }}" class="btn btn-success">
                            <i class="bi bi-file-earmark-pdf me-1"></i> PDF
                        </a>
                        <a href="{{ route('laporan.export.excel', request()->query()) }}" class="btn btn-warning text-white">
                            <i class="bi bi-file-earmark-excel me-1"></i> Excel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Lokasi</th>
                            <th>Jenis Pangan</th>
                            <th>Jumlah Stok</th>
                            <th>Tanggal Input</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}</td>
                                <td>{{ $item->lokasi->nama_lokasi ?? '-' }}</td>
                                <td>{{ $item->pangan->nama_pangan ?? '-' }}</td>
                                <td>{{ $item->jumlah_stok }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_input)->format('d/m/Y') }}</td>
                                <td>
                                    @php
                                        $badgeClass = match($item->status) {
                                            'Aman' => 'success',
                                            'Waspada' => 'warning',
                                            'Kritikal' => 'danger',
                                            default => 'secondary',
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $badgeClass }}">{{ $item->status }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Data tidak tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {{ $data->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
