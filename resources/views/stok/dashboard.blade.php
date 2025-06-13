@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">
        <i class="bi bi-graph-up-arrow me-2"></i> Dashboard Stok Pangan
    </h3>

    <div class="row">
        <!-- Grafik Stok per Jenis Pangan -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Stok per Jenis Pangan</h6>
                    <canvas id="stokChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik Distribusi Status Stok -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Distribusi Status Stok</h6>
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik Tren Jumlah Stok per Tanggal -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Tren Jumlah Stok per Tanggal</h6>
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik Stok per Lokasi -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Stok per Lokasi</h6>
                    <canvas id="lokasiChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const stokByPangan = {!! json_encode($stokByPangan) !!};
    const stokStatus = {!! json_encode($stokStatus) !!};
    const stokPerTanggal = {!! json_encode($stokPerTanggal) !!};
    const stokPerLokasi = {!! json_encode($stokPerLokasi) !!};

    new Chart(document.getElementById('stokChart'), {
        type: 'bar',
        data: {
            labels: Object.keys(stokByPangan),
            datasets: [{
                label: 'Jumlah Stok',
                data: Object.values(stokByPangan),
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                borderRadius: 5,
            }]
        }
    });

    const statusLabels = ['Aman', 'Waspada', 'Kritikal'];
    const statusColors = {
        'Aman': '#28a745',     // Hijau
        'Waspada': '#ffc107',  // Kuning
        'Kritikal': '#dc3545'  // Merah
    };
    const statusData = statusLabels.map(label => stokStatus[label] ?? 0); // kalau null, jadikan 0

    new Chart(document.getElementById('statusChart'), {
        type: 'pie',
        data: {
            labels: statusLabels,
            datasets: [{
                label: 'Status',
                data: statusData,
                backgroundColor: statusLabels.map(label => statusColors[label]),
            }]
        }
    });


    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: Object.keys(stokPerTanggal),
            datasets: [{
                label: 'Jumlah Stok',
                data: Object.values(stokPerTanggal),
                fill: true,
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.3
            }]
        }
    });

    new Chart(document.getElementById('lokasiChart'), {
        type: 'polarArea',
        data: {
            labels: Object.keys(stokPerLokasi),
            datasets: [{
                label: 'Stok',
                data: Object.values(stokPerLokasi),
                backgroundColor: ['#007bff', '#17a2b8', '#28a745', '#ffc107', '#dc3545'],
            }]
        }
    });
</script>
@endpush
