<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; color: #db2777; }
        .header p { margin: 5px 0; color: #555; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px; }
        th { background-color: #fce7f3; color: #333; }
        
        .total-box {
            margin-top: 20px;
            text-align: right;
            font-weight: bold;
            font-size: 16px;
        }
        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 10px;
            color: #888;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>PANDA LOVELY</h1>
        <h3>Laporan Penjualan</h3>
        
        {{-- BAGIAN INI SUDAH DIPERBAIKI (Menggunakan tgl_mulai) --}}
        <p>Periode: 
            @if(isset($tgl_mulai) && isset($tgl_selesai))
                {{ \Carbon\Carbon::parse($tgl_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($tgl_selesai)->format('d M Y') }}
            @else
                Semua Waktu
            @endif
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>No. Transaksi</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporan as $index => $trx)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $trx->created_at->format('d/m/Y H:i') }}</td>
                <td>#TRX-{{ $trx->id }}</td>
                <td>Rp {{ number_format($trx->total_price, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align:center">Tidak ada data penjualan pada periode ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="total-box">
        Total Pendapatan: Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
    </div>

    <div class="footer">
        Dicetak oleh: {{ Auth::user()->name ?? 'Admin' }} <br>
        Tanggal Cetak: {{ now()->format('d/m/Y H:i') }}
    </div>

</body>
</html>