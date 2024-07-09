<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan dan Stok</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .right { text-align: right; }
        .header-right { float: right; }
    </style>
</head>
<body>
    <h1 align="center">LAPORAN PENJUALAN</h1>
    <hr>
    <div class="header-right">
        <strong>Tanggal Laporan: </strong>{{ $laporan->tgl_laporan }}
    </div>
    <br>
    <h2>Pendapatan</h2>
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>{{ $laporan->periode == 'bulanan' ? 'Bulan' : 'Tanggal' }}</th>
                <th>Total Pendapatan</th>
                <th>Total Pendapatan Bersih</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $laporan->kode }}</td>
                <td>
                    @if ($laporan->periode == 'bulanan')
                        {{ \Carbon\Carbon::parse($laporan->tgl_laporan)->format('F Y') }}
                    @else
                        {{ $laporan->transaksi->first()->tgl_transaksi ?? '' }}
                    @endif
                </td>
                <td>{{ number_format($laporan->total_pendapatan, 0, ',', '.') }}</td>
                <td>{{ number_format($laporan->total_pendapatan_bersih, 0, ',', '.') }}
            </tr>
        </tbody>
    </table>

    <h2>Detail Transaksi</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal Transaksi</th>
                <th>Kode Transaksi</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan->transaksi as $transaksi)
            <tr>
                <td>{{ $transaksi->tgl_transaksi }}</td>
                <td>{{ $transaksi->kode }}</td>
                <td>{{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
