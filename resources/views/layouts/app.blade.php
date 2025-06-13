<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM-KePang</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- CSS Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

    @if(session('user'))
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3 mb-4">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('stok.index') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="50" height="50" class="me-2">
            <div>
                <div class="fw-bold">SIM-KePang</div>
                <div class="text-white-50" style="font-size: 0.75rem;">Sistem Monitoring Ketersediaan Pangan</div>
            </div>
        </a>

        <!-- Tombol Hamburger (untuk mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Menu -->
<div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
        {{-- Hanya tampil jika Admin --}}
        @if(auth()->check() && auth()->user()->role === 'admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('stok.index') }}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('lokasi.index') }}">Lokasi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('jenis.index') }}">Jenis Pangan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('laporan.index') }}">Laporan</a>
            </li>
        @elseif(auth()->user()->role === 'user')
            {{-- Hanya tampil jika User --}}
            <li class="nav-item">
                <a class="nav-link" href="{{ route('laporan.index') }}">Laporan</a>
            </li>
        @endif
    </ul>

    {{-- Info nama dan role --}}
               @if(auth()->check())
                @php
                    $fullName = auth()->user()->name;
                    $nameParts = explode(' ', $fullName);
                    $lastName = count($nameParts) > 1 ? last($nameParts) : $fullName;
                @endphp
                <span class="navbar-text text-white-50 ms-auto me-2">
                    {{ \App\Helpers\GeneralHelper::greetingByTime() }}, {{ $lastName }}
                </span>
            @endif

            @if(auth()->user()->role === 'admin')
    <div class="text-white-50 me-3">
        | Admin
    </div>
    @elseif(auth()->user()->role === 'pengguna')
    <div class="text-white-50 me-3">
        | User
    </div>
@endif

<!-- CSS langsung dalam halaman -->
<style>
    .small-text {
        font-size: 0.8rem; /* Atur ukuran font sesuai kebutuhan */
        color: #17a2b8; /* Sesuaikan warna teks jika diperlukan */
    }
</style>


            <!-- Logout button -->
            <form action="{{ route('logout') }}" method="POST" class="d-flex">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            </form>
        </div>
    </nav>
    @endif

    <div class="container mb-5">
        @yield('content')
        @stack('scripts')
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        &copy; 2025 Devis Pringga_23552012004
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
