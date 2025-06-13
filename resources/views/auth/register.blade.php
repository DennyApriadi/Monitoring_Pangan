<!DOCTYPE html>
<html>
<head>
    <title>Register - SIM-KePang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .register-card {
            max-width: 450px;
            margin: 6% auto;
            padding: 2rem;
            padding-bottom: 1rem; /* Tambahan ini */
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
    <div class="card register-card bg-white">
        <div class="text-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-img">
            <h4 class="mt-3">Daftar Akun SIM-KePang</h4>
        </div>

        <form method="POST" action="{{ route('register') }}" class="mt-3">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}">
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

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Sandi</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success w-100">Daftar</button>
        </form>

        <div class="text-center mt-3">
            <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
            <a href="{{ route('home') }}" class="text-secondary small">← Kembali</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
