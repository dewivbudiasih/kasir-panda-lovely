<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Panda Lovely</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F3F4F6;
        }

        /* Sidebar Styling */
        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            color: #4B5563;
            /* Gray-600 */
            font-weight: 500;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .nav-link:hover {
            background-color: #FCE7F3;
            /* Pink-100 */
            color: #DB2777;
            /* Pink-600 */
        }

        .nav-link.active {
            background-color: #FFFFFF;
            color: #DB2777;
            font-weight: 600;
            border-left: 4px solid #DB2777;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body class="text-gray-800 h-screen overflow-hidden flex bg-gray-50">

    <aside class="w-64 bg-[#FFF0F5] border-r border-pink-100 flex-shrink-0 flex flex-col justify-between hidden md:flex z-20">
        <div>
            <div class="h-24 flex items-center px-8 mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center shadow-sm overflow-hidden">
                        <img src="{{ asset('img/panda.jpg') }}" alt="Panda" class="w-full h-full object-cover">
                    </div>
                    <div class="leading-tight">
                        <h1 class="font-bold text-lg text-pink-600 tracking-wide">PANDA</h1>
                        <span class="text-sm font-semibold text-pink-400 tracking-wider">LOVELY</span>
                    </div>
                </div>
            </div>

            <nav class="flex flex-col gap-1 pr-4">
                <a href="{{ route('admin.dashboard') }}" class="nav-link active rounded-r-xl">
                    <i class="ph-bold ph-squares-four text-xl"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ Route::has('produk.index') ? route('produk.index') : '#' }}" class="nav-link rounded-r-xl">
                    <i class="ph-bold ph-package text-xl"></i>
                    <span>Produk</span>
                </a>
                <a href="{{ Route::has('kategori.index') ? route('kategori.index') : '#' }}" class="nav-link rounded-r-xl">
                    <i class="ph-bold ph-tag text-xl"></i>
                    <span>Kategori</span>
                </a>
                <a href="{{ Route::has('laporan.index') ? route('laporan.index') : '#' }}" class="nav-link rounded-r-xl">
                    <i class="ph-bold ph-file-text text-xl"></i>
                    <span>Laporan</span>
                </a>
                <a href="{{ Route::has('staf.index') ? route('staf.index') : '#' }}" class="nav-link rounded-r-xl">
                    <i class="ph-bold ph-users text-xl"></i>
                    <span>Staf</span>
                </a>
                <a href="{{ Route::has('pengaturan.index') ? route('pengaturan.index') : '#' }}" class="nav-link rounded-r-xl">
                    <i class="ph-bold ph-gear text-xl"></i>
                    <span>Pengaturan</span>
                </a>
            </nav>
        </div>

        <div class="p-6">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-pink-500 text-white rounded-xl hover:bg-pink-600 transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5 font-medium">
                    <i class="ph-bold ph-sign-out text-lg"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-screen overflow-hidden relative">

        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8 shadow-sm z-10 sticky top-0">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Selamat Datang, {{ Auth::user()->name ?? 'Admin' }}!</h2>
                <p class="text-xs text-gray-400 mt-1">Pantau performa Panda Lovely hari ini.</p>
            </div>

            <div class="flex items-center gap-4">
                <div class="px-4 py-2 bg-pink-50 rounded-full border border-pink-100 text-pink-600 text-sm font-medium flex items-center gap-2">
                    <i class="ph-fill ph-calendar-blank"></i>
                    {{ date('d F Y') }}
                </div>
            </div>
        </header>

       <main class="flex-1 overflow-y-auto bg-[#F9FAFB] p-6">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

        <div class="bg-white p-4 rounded border border-gray-200">
            <h4 class="text-gray-500 text-sm font-medium mb-1">Total Produk</h4>
            <div class="text-2xl font-bold text-gray-800">{{ number_format($totalProduk ?? 0) }}</div>
        </div>

        <div class="bg-white p-4 rounded border border-gray-200">
            <h4 class="text-gray-500 text-sm font-medium mb-1">Omset Hari Ini</h4>
            <div class="text-2xl font-bold text-gray-800">Rp {{ number_format($penjualanHariIni ?? 0, 0, ',', '.') }}</div>
        </div>

        <div class="bg-white p-4 rounded border border-gray-200">
            <h4 class="text-gray-500 text-sm font-medium mb-1">Omset Bulan Ini</h4>
            <div class="text-2xl font-bold text-gray-800">Rp {{ number_format($penjualanBulanIni ?? 0, 0, ',', '.') }}</div>
        </div>

        <div class="bg-white p-4 rounded border border-gray-200">
            <h4 class="text-gray-500 text-sm font-medium mb-1">Total Staf</h4>
            <div class="text-2xl font-bold text-gray-800">{{ $totalUser ?? 0 }}</div>
        </div>
    </div>

            <div class="bg-white border border-gray-200 rounded p-5">
                <div class="mb-4">
                    <h3 class="font-bold text-gray-700">Riwayat Transaksi Terakhir</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-gray-100 font-semibold text-gray-700">
                            <tr>
                                <th class="p-3 border-b">ID Struk</th>
                                <th class="p-3 border-b">Waktu</th>
                                <th class="p-3 border-b">Kasir</th>
                                <th class="p-3 border-b">Total</th>
                                <th class="p-3 border-b text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayatTransaksi as $t)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3">
                                    #{{ $t->invoice_code ?? $t->id }}
                                </td>
                                <td class="p-3">
                                    {{ $t->created_at->format('H:i') }}
                                </td>
                                <td class="p-3">
                                    {{ $t->user->name ?? '-' }}
                                </td>
                                <td class="p-3 font-bold text-gray-800">
                                    Rp {{ number_format($t->total_price ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="p-3 text-right">
                                    @php $status = strtolower($t->status ?? ''); @endphp

                                    @if(in_array($status, ['success', 'lunas', 'paid']))
                                    <span class="text-green-600 font-bold">Lunas</span>
                                    @else
                                    <span class="text-orange-500 font-bold">{{ ucfirst($t->status ?? 'Pending') }}</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-6 text-center text-gray-400">
                                    Belum ada transaksi hari ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8 text-center text-xs text-gray-400 pb-4">
                &copy; {{ date('Y') }} Panda Lovely System.
            </div>

        </main>
    </div>

</body>

</html>