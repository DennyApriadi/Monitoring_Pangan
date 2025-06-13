<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Monitoring Ketersediaan Pangan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
            margin: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 40px;
            font-size: 11px;
            text-align: right;
        }
        .logo-container {
            text-align: center;
            margin-bottom: 10px;
        }
        .logo-container img {
            height: 80px;
        }
    </style>
</head>
<body>
    <div class="logo-container">
        <img src="{{ public_path('logo.png') }}" alt="Logo">
    </div>

    <h2>Laporan Monitoring Ketersediaan Pangan</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Lokasi</th>
                <th>Provinsi</th>
                <th>Kota</th>
                <th>Jenis Pangan</th>
                <th>Jumlah Stok</th>
                <th>Tanggal Input</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->lokasi->nama_lokasi ?? '-' }}</td>
                <td>{{ $item->lokasi->provinsi ?? '-' }}</td>
                <td>{{ $item->lokasi->kota ?? '-' }}</td>
                <td>{{ $item->pangan->nama_pangan ?? '-' }}</td>
                <td>{{ number_format($item->jumlah_stok) }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_input)->format('d/m/Y') }}</td>
                <td>{{ ucfirst($item->status) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center;">Tidak ada data yang tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }} <br> &copy; 2025 Devis Pringga 23552012004
    </div>
</body>
</html>
