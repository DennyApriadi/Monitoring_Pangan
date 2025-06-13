<!DOCTYPE html>
<html>
<head>
    <title>Login - SIM-KePang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-card {
            max-width: 400px;
            margin: 5% auto;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .logo-img {
            width: 80px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card login-card bg-white">
        <div class="text-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-img">
            <h4 class="mt-3">Login ke SIM-KePang</h4>
        </div>

        @if (session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif



        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" name="email" id="email" class="form-control" required autofocus value="{{ old('email') }}">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" name="password" id="password" class="form-control" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Masuk</button>
        </form>

        <p class="text-muted" style="font-size: 12px; text-align: center;">Hanya admin yang dapat mengakses halaman ini.</p>


        <div class="text-center mt-3">
            <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
            <a href="{{ route('home') }}" class="text-secondary small">← Kembali</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
