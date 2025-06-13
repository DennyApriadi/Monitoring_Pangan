<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM-KePang</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('{{ asset('images/hero-bg.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
        }

        .overlay {
            background-color: rgba(255, 255, 255, 0.5);
            min-height: 100vh;
            padding-top: 4rem;
            padding-bottom: 4rem;
            animation: fadeIn 1s ease-in-out;
        }

        .welcome-card,
        .description-section {
            background-color: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            animation: slideUp 0.8s ease-in-out;
            max-height: 600px; /* atau sesuaikan sesuai kebutuhan */
        }

        .welcome-card {
            max-width: 400px;
            padding: 3rem;
            background-color: rgba(255, 255, 255, 0.6); /* <-- Transparansi login card */
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            animation: slideUp 0.8s ease-in-out;
        }

        .logo-img {
            width: 100px;
            height: auto;
        }

        .subtext {
            font-size: 1rem;
            color: #6c757d;
        }

        .description-section {
            text-align: justify;
            padding: 2rem;
        }

        .scroll-box {
            max-height: 470px;
            overflow-y: auto;
            padding-right: 10px;

        }

        .justify-text {
        text-align: justify;
        }

        /* Animasi */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .flex-md-row {
                flex-direction: column !important;
            }

            .welcome-card {
                margin-bottom: 2rem;
            }
        }
    </style>
</head>
<body>
<div class="overlay">
    <div class="container">
        <div class="d-flex flex-md-row flex-column align-items-stretch gap-4">

            <!-- Deskripsi Aplikasi -->
            <div class="description-section w-100">
                <h4 class="mb-4">Tentang Aplikasi</h4>
                <div class="scroll-box">
                    <p class="text-justify">
                        <strong>SIM-KePang</strong> adalah Sistem Informasi Monitoring Ketersediaan Pangan yang dirancang untuk memantau dan mengelola data terkait ketersediaan pangan di berbagai lokasi khusus di Kabupaten Garut.
                        Aplikasi ini membantu dalam pengambilan keputusan cepat terkait stok pangan, dengan fitur-fitur seperti Manajemen Jenis Pangan, Lokasi, serta Laporan Stok yang lengkap.
                    </p>
                    <p class="text-justify"> Fitur utama Aplikasi:
                        <ul style="list-style: none; padding-left: 0;">
                            <li>✅ Manajemen Data Jenis Pangan</li>
                            <li>✅ Monitoring Stok di Berbagai Lokasi</li>
                            <li>✅ Laporan Grafik Ketersediaan Pangan</li>
                            <li>✅ Ekspor Data dalam Format Excel dan PDF</li>
                        </ul>
                    <p class="text-justify"> Dengan menggunakan aplikasi ini, diharapkan pengelolaan data pangan menjadi lebih terstruktur, efisien, dan mudah diakses kapan saja.
                    </p>
                    <p class="text-justify"> Aplikasi ini merupakan proyek kelompok 1 sebagai salah satu tugas Ujian Tengah Semester Genap Tahun 2025 pada Mata Kuliah Pemrograman Web 2 Kelas PK22 dengan Dosen Ibu Sela Octaviani, S.Kom. M.Kom.</p>
                    </p>
                    <p class="text-justify"> Semoga Aplikasi ini dapat dikembangkan sebagai bagian dari proyek akhir di Universitas Teknologi Bandung. Terima kasih telah menggunakan SIM-KePang!
                    </p>
                </div>
            </div>

            <!-- Kartu Welcome -->
            <div class="welcome-card text-center w-100">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-img mb-2 mx-auto">
                <h3 class="mb-0">Selamat Datang di<br><strong>SIM-KePang</strong></h3>
                <p class="subtext mb-2" style="font-size: 14px;">Sistem Monitoring Ketersediaan Pangan</p>
                <br>
                <p class="subtext mb-0">Kelompok 1</p>
                <p class="subtext mb-0" style="font-size: 14px;">Deni Apriadi - 22552011290</p>
                <p class="subtext mb-0" style="font-size: 14px;">Maghfira Fiolife - 22552011229</p>
                <p class="subtext mb-0" style="font-size: 14px;">Sapari Putra Pamungkas - 22552011218</p>
                <p class="subtext mb-0" style="font-size: 14px;">Devis Pringga - 23552012004</p>
                <br>
                <a href="{{ url('/register') }}" class="btn btn-success w-100 mb-2">Register</a>
                <a href="{{ url('/login') }}" class="btn btn-primary w-100">Login</a>
                <br>
                <br>
                <p class="subtext mt-0" style="font-size: 12px;">&copy;2025 Universitas Teknologi Bandung</p>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
