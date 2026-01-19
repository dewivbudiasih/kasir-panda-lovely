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
            background-color: #F9FAFB;
        }

        .bg-sidebar {
            background-color: #FCE7F3;
        }

        .btn-pink {
            background-color: #EC4899;
            color: white;
        }

        .btn-pink:hover {
            background-color: #DB2777;
        }

        .active-menu {
            background-color: #FFFFFF;
            color: #DB2777;
            font-weight: 600;
            border-radius: 0 10px 10px 0;
            border-left: 4px solid #DB2777;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 2rem;
            color: #4B5563;
            transition: all 0.3s;
            border-radius: 0 10px 10px 0;
        }

        .nav-item:hover {
            background-color: #FBCFE8;
            color: #BE185D;
            padding-left: 2.5rem;
        }
    </style>
</head>

<body class="text-gray-800">

    <div class="flex h-screen overflow-hidden">
        <aside class="w-64 bg-sidebar flex flex-col justify-between py-6 pl-0 pr-4 shadow-lg z-10 hidden md:flex">
            <div>
                <div class="flex items-center gap-4 px-4 mb-10">
                    <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-sm p-1">
                        <img src="{{ asset('img/panda.jpg') }}" alt="Logo Panda" class="w-full h-full object-cover rounded-full">
                    </div>

                    <div>
                        <h1 class="text-xl font-bold tracking-wider leading-none text-pink-600">PANDA</h1>
                        <h1 class="text-xl font-bold tracking-wider leading-none text-pink-400">LOVELY</h1>
                    </div>
                </div>

                <nav class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="active-menu flex items-center gap-3 px-8 py-3">
                        <i class="ph-fill ph-squares-four text-xl"></i> <span>Dashboard</span>
                    </a>
                    <a href="{{ Route::has('produk.index') ? route('produk.index') : '#' }}" class="nav-item">
                        <i class="ph-fill ph-package text-xl"></i> <span>Produk</span>
                    </a>
                    <a href="{{ Route::has('kategori.index') ? route('kategori.index') : '#' }}" class="nav-item">
                        <i class="ph-fill ph-tag text-xl"></i> <span>Kategori</span>
                    </a>
                    <a href="{{ Route::has('laporan.index') ? route('laporan.index') : '#' }}" class="nav-item">
                        <i class="ph-fill ph-file-text text-xl"></i> <span>Laporan</span>
                    </a>
                    <a href="{{ Route::has('staf.index') ? route('staf.index') : '#' }}" class="nav-item">
                        <i class="ph-fill ph-users text-xl"></i> <span>Staf</span>
                    </a>
                    <a href="{{ Route::has('pengaturan.index') ? route('pengaturan.index') : '#' }}" class="nav-item">
                        <i class="ph-fill ph-gear text-xl"></i> <span>Pengaturan</span>
                    </a>
                </nav>
            </div>

            <div class="px-6">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 btn-pink rounded-xl transition shadow-md hover:shadow-lg transform hover:-translate-y-1">
                        <i class="ph-bold ph-sign-out text-lg"></i> <span class="font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col overflow-y-auto bg-[#F9FAFB]">
            <header class="flex justify-between items-center py-5 px-8 bg-white border-b border-gray-100 shadow-sm sticky top-0 z-20">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Selamat Datang, {{ Auth::user()->name ?? 'Admin' }}!</h2>
                    <p class="text-gray-400 text-xs mt-1">Pantau performa Panda Lovely hari ini.</p>
                </div>
                <div class="flex items-center gap-2 bg-pink-50 px-4 py-2 rounded-full border border-pink-100 text-pink-600 font-medium text-sm">
                    <i class="ph-fill ph-calendar-blank text-lg"></i> <span>{{ date('d F Y') }}</span>
                </div>
            </header>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition group">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wide">Total Produk</p>
                                <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ number_format($totalProduk ?? 0) }}</h3>
                            </div>
                            <div class="p-3 bg-pink-50 text-pink-500 rounded-xl group-hover:bg-pink-500 group-hover:text-white transition">
                                <i class="ph-fill ph-package text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition group">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wide">Omset Hari Ini</p>
                                <h3 class="text-2xl font-bold text-gray-800 mt-2">Rp {{ number_format($penjualanHariIni ?? 0, 0, ',', '.') }}</h3>
                            </div>
                            <div class="p-3 bg-green-50 text-green-500 rounded-xl group-hover:bg-green-500 group-hover:text-white transition">
                                <i class="ph-fill ph-trend-up text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-purple-500 to-indigo-600 p-5 rounded-2xl shadow-lg text-white transform hover:scale-105 transition duration-300">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-xs text-purple-100 font-bold uppercase tracking-wide opacity-80">Omset Bulan Ini</p>
                                <h3 class="text-2xl font-bold mt-2">Rp {{ number_format($penjualanBulanIni ?? 0, 0, ',', '.') }}</h3>
                            </div>
                            <div class="p-2 bg-white bg-opacity-20 rounded-lg">
                                <i class="ph-fill ph-calendar-check text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition group">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wide">Total Staf</p>
                                <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $totalUser ?? 0 }}</h3>
                            </div>
                            <div class="p-3 bg-orange-50 text-orange-500 rounded-xl group-hover:bg-orange-500 group-hover:text-white transition">
                                <i class="ph-fill ph-users text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-6">Riwayat Transaksi Terakhir</h3>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-xs text-gray-400 font-bold uppercase tracking-wider border-b border-gray-100">
                                    <th class="py-3 pl-2">ID Struk</th>
                                    <th class="py-3">Waktu</th>
                                    <th class="py-3">Kasir</th>
                                    <th class="py-3">Total</th>
                                    <th class="py-3 text-right pr-2">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50 text-sm">
                                @forelse($riwayatTransaksi as $t)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="py-4 pl-2 font-semibold text-gray-700">#{{ $t->invoice_code ?? $t->id }}</td>
                                    <td class="py-4 text-gray-500">{{ $t->created_at->format('H:i') }}</td>
                                    <td class="py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-full bg-pink-100 flex items-center justify-center text-[10px] text-pink-500 font-bold uppercase">
                                                {{ substr($t->user->name ?? 'K', 0, 1) }}
                                            </div>
                                            <span class="font-medium text-gray-600">{{ $t->user->name ?? 'Kasir' }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 font-bold text-gray-800">Rp {{ number_format($t->total_price ?? 0, 0, ',', '.') }}</td>

                                    <td class="py-4 text-right pr-2">
                                        @php
                                        $status = strtolower($t->status ?? '');
                                        @endphp

                                        @if(in_array($status, ['success', 'lunas', 'paid', 'sukses']))
                                        <span class="bg-green-100 text-green-600 py-1 px-3 rounded-full text-[10px] font-bold uppercase">
                                            LUNAS
                                        </span>
                                        @else
                                        <span class="bg-yellow-100 text-yellow-600 py-1 px-3 rounded-full text-[10px] font-bold uppercase">
                                            {{ $t->status ?? 'LUNAS' }}
                                        </span>
                                        @endif
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center text-gray-400">
                                        <p>Belum ada transaksi hari ini.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>