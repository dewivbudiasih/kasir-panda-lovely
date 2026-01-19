<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
       
        @page { size: 58mm auto; margin: 0; }
        
        body { 
            font-family: 'Courier New', Courier, monospace; 
            width: 58mm; 
            margin: 0 auto; 
            padding: 10px;
            font-size: 11px;
            color: #000;
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
        }

        .table { 
            width: 100%; 
            border-collapse: collapse; 
        }

        .table td { padding: 2px 0; vertical-align: top; }
    </style>
</head>
<body onload="window.print()">

    <div class="text-center section">
        <h2 class="shop-name font-bold">PANDA LOVELY</h2>
        <div style="font-size: 10px;">
            Jalan Pahlawan No. 183, Kota Mojokerto <br>
            Telp: 088-230-261-995
        </div>
    </div>

    <div class="line"></div>

    <table class="table">
        <tr>
            <td>No: {{ $transaction->invoice_code }}</td>
            <td class="text-right">{{ $transaction->created_at->format('d/m/y H:i') }}</td>
        </tr>
        <tr>
            <td colspan="2">Kasir: {{ $transaction->user->name }}</td>
        </tr>
    </table>

    <div class="line"></div>

    <table class="table">
        @foreach($transaction->details as $detail)
        <tr>
            <td colspan="2">{{ $detail->product->name }}</td>
        </tr>
        <tr>
            <td style="padding-left: 5px;">{{ $detail->quantity }} x {{ number_format($detail->price, 0, ',', '.') }}</td>
            <td class="text-right">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>

    <div class="line"></div>

    <table class="table font-bold" style="font-size: 13px;">
        <tr>
            <td>TOTAL</td>
            <td class="text-right">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="line"></div>

    <div class="text-center section" style="margin-top: 10px;">
        <p class="font-bold">*** TERIMA KASIH ***</p>
        <p>Barang yang sudah dibeli<br>tidak dapat ditukar/dikembalikan</p>
    </div>

</body>
</html>