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

    @if(request('lokasi_id') || request('pangan_id') || request('status'))
        <p><strong>Filter:</strong></p>
        <ul>
            @if(request('lokasi_id'))
                <li>Lokasi: {{ optional($data->first()->lokasi)->nama_lokasi ?? '-' }}</li>
            @endif
            @if(request('pangan_id'))
                <li>Jenis Pangan: {{ optional($data->first()->pangan)->nama_pangan ?? '-' }}</li>
            @endif
            @if(request('status'))
                <li>Status: {{ request('status') }}</li>
            @endif
        </ul>
    @endif

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
                    <td>{{ $item->jumlah_stok }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_input)->format('d/m/Y') }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
