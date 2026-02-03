<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran - {{ $pengaturan->nama_toko ?? 'Panda Lovely' }}</title>
    <style>
        @page { 
            size: 58mm auto; 
            margin: 0; 
        }
        
        body { 
            font-family: 'Courier New', Courier, monospace; 
            width: 58mm; 
            margin: 0 auto; 
            padding: 8px;
            font-size: 11px;
            color: #000;
            background: #fff;
        }

        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }

        .line { 
            border-bottom: 1px dashed #000; 
            margin: 8px 0; 
            width: 100%;
        }

        .section {
            display: block;
            width: 100%;
            margin-bottom: 5px;
        }

        .shop-name { 
            font-size: 16px; 
            margin: 0; 
            letter-spacing: 1px;
            text-transform: uppercase; /* Agar nama toko kapital semua */
        }

        .address {
            font-size: 9px;
            margin-top: 2px;
            line-height: 1.2;
        }

        .table { 
            width: 100%; 
            border-collapse: collapse; 
        }

        .table td { 
            padding: 2px 0; 
            vertical-align: top; 
        }

        .total-area {
            font-size: 12px;
        }
    </style>
</head>
<body onload="window.print()">

    <div class="text-center section">
        <h2 class="shop-name font-bold">
            {{ $pengaturan->nama_toko ?? 'PANDA LOVELY' }}
        </h2>
        <div class="address">
            {{ $pengaturan->alamat ?? 'Alamat Toko Belum Diatur' }} <br>
            Telp: {{ $pengaturan->no_hp ?? '-' }}
        </div>
    </div>
    <div class="line"></div>

    <table class="table">
        <tr>
            <td>No: {{ $transaction->invoice_code }}</td>
            <td class="text-right">{{ $transaction->created_at->format('d/m/y H:i') }}</td>
        </tr>
        <tr>
            <td colspan="2">Kasir: {{ $transaction->user->name ?? 'Admin' }}</td>
        </tr>
    </table>

    <div class="line"></div>

    <table class="table">
        @foreach($transaction->details as $detail)
        <tr>
            <td colspan="2" class="font-bold">{{ $detail->product->name }}</td>
        </tr>
        <tr>
            <td style="padding-left: 5px;">
                {{ $detail->quantity }} x {{ number_format($detail->price, 0, ',', '.') }}
            </td>
            <td class="text-right">
                Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
            </td>
        </tr>
        @endforeach
    </table>

    <div class="line"></div>

    <table class="table total-area">
        <tr>
            <td class="font-bold">TOTAL</td>
            <td class="text-right font-bold">
                Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
            </td>
        </tr>
        <tr>
            <td>Tunai</td>
            <td class="text-right">
                Rp {{ number_format($transaction->bayar, 0, ',', '.') }}
            </td>
        </tr>
        <tr>
            <td>Kembalian</td>
            <td class="text-right">
                Rp {{ number_format($transaction->kembalian, 0, ',', '.') }}
            </td>
        </tr>
    </table>

    <div class="line"></div>

    <div class="text-center section" style="margin-top: 10px;">
        <p style="font-size: 10px;">
            Terima Kasih atas Kunjungan Anda<br>
            <i>Barang yang sudah dibeli<br>tidak dapat ditukar kembali</i>
        </p>
    </div>

</body>
</html>