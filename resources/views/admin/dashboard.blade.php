@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Dashboard Admin</h2>

    <div class="alert alert-success">
        Selamat datang di halaman admin, <strong>{{ Auth::user()->name }}</strong>!
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Manajemen Data</h5>
                    <p class="card-text">Kelola data lokasi, jenis pangan, dan stok pangan di sini.</p>
                    <a href="{{ route('stok.index') }}" class="btn btn-primary">Lihat Data</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mt-3 mt-md-0">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Laporan</h5>
                    <p class="card-text">Lihat dan cetak laporan data ketersediaan pangan.</p>
                    <a href="{{ route('laporan.index') }}" class="btn btn-secondary">Lihat Laporan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
