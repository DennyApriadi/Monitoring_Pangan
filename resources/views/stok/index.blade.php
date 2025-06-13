@extends('layouts.app')

@section('content')
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0">
                    <i class="bi bi-box-seam me-2 text-primary"></i> Data Stok Pangan
                </h3>
                <div>
                    <a href="{{ route('stok.create') }}" class="btn btn-primary shadow-sm me-2">
                        <i class="bi bi-plus me-1"></i> Tambah Stok
                    </a>
                    <a href="{{ route('stok.dashboard') }}" class="btn btn-outline-info">
                        <i class="bi bi-graph-up me-1"></i> Grafik
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>Lokasi</th>
                            <th>Jenis Pangan</th>
                            <th>Jumlah Stok</th>
                            <th>Status</th>
                            <th>Tanggal Input</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stok as $s)
                            <tr>
                                <td>{{ $s->lokasi->nama_lokasi }}</td>
                                <td>{{ $s->pangan->nama_pangan }}</td>
                                <td class="text-center">{{ $s->jumlah_stok }}</td>
                                <td class="text-center">
                                    <span class="badge bg-{{ $s->status == 'Aman' ? 'success' : ($s->status == 'Waspada' ? 'warning text-dark' : 'danger') }}">
                                        {{ $s->status }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($s->tanggal_input)->format('d M Y') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('stok.edit', $s->id) }}" class="btn btn-sm btn-outline-warning me-1">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('stok.destroy', $s->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Yakin hapus data?')" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="bi bi-info-circle me-2"></i> Belum ada data stok.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $stok->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>

            <div class="mb-5">
                <h5><i class="bi bi-graph-up-arrow text-primary me-2"></i> Grafik Jumlah Stok per Jenis Pangan</h5>
                <canvas id="stokChart" height="100"></canvas>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('stokChart').getContext('2d');
    const stokChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($stokByPangan->keys()) !!},
            datasets: [{
                label: 'Jumlah Stok',
                data: {!! json_encode($stokByPangan->values()) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                borderRadius: 5,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endpush
