<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #eee;
            font-weight: bold;
        }
        h2, p {
            margin: 0;
            padding: 2px 0;
        }
    </style>
</head>
<body>
    <h2>Laporan Monitoring Ketersediaan Pangan</h2>
    <p>Tanggal: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>

    {{-- 3 baris kosong sebelum data --}}
    <table>
        <tr><td colspan="8"></td></tr>
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
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->lokasi->nama_lokasi ?? '-' }}</td>
                    <td>{{ $item->lokasi->provinsi ?? '-' }}</td>
                    <td>{{ $item->lokasi->kota ?? '-' }}</td>
                    <td>{{ $item->pangan->nama_pangan ?? '-' }}</td>
                    <td>{{ $item->jumlah_stok }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_input)->format('d/m/Y') }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
