<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi - Panda Lovely</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                <i class="fas fa-history text-pink-500 mr-2"></i> Riwayat Transaksi
            </h1>
            <a href="{{ route('kasir.dashboard') }}" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 transition">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-pink-50 text-pink-700 text-sm uppercase">
                        <th class="p-4 font-bold border-b">No. Invoice</th>
                        <th class="p-4 font-bold border-b">Waktu</th>
                        <th class="p-4 font-bold border-b">Kasir</th>
                        <th class="p-4 font-bold border-b text-right">Total Belanja</th>
                        <th class="p-4 font-bold border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @forelse($transactions as $trx)
                    <tr class="hover:bg-gray-50 border-b last:border-0 transition">
                        <td class="p-4 font-bold text-gray-800">#{{ $trx->invoice_code }}</td>
                        <td class="p-4">{{ $trx->created_at->format('d M Y H:i') }}</td>
                        <td class="p-4">
                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs font-bold">
                                {{ $trx->user->name ?? 'Kasir Dihapus' }}
                            </span>
                        </td>
                        <td class="p-4 text-right font-bold text-pink-600">
                            Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                        </td>
                        <td class="p-4 text-center">
                            <a href="{{ route('transaksi.struk', $trx->id) }}" target="_blank" class="bg-blue-50 text-blue-600 hover:bg-blue-100 px-3 py-2 rounded-lg text-xs font-bold transition">
                                <i class="fas fa-print mr-1"></i> Cetak Struk
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-10 text-center text-gray-400">
                            <i class="fas fa-inbox text-4xl mb-3"></i>
                            <p>Belum ada transaksi.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div class="p-4 border-t">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>

</body>
</html>