<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir - Panda Lovely</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F8FAFC;
        }

        .bg-sidebar {
            background-color: #FFF1F2;
            border-right: 1px solid #FECDD3;
        }

        .nav-item {
            color: #64748B;
            transition: all 0.2s;
            border-radius: 0.75rem;
            font-weight: 500;
        }

        .nav-item:hover:not(.active) {
            background-color: #FFE4E6;
            color: #BE123C;
        }

        .nav-item.active {
            background-color: #EC4899;
            color: #FFFFFF;
            box-shadow: 0 4px 6px -1px rgba(236, 72, 153, 0.3);
            font-weight: 600;
        }

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #F1F5F9;
        }

        ::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94A3B8;
        }
    </style>
</head>

<body class="text-slate-800 antialiased h-screen overflow-hidden flex">

    <div id="sidebarOverlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/50 z-20 hidden md:hidden transition-opacity backdrop-blur-sm"></div>

    <aside id="sidebar" class="w-64 bg-sidebar fixed md:static h-full z-30 transform -translate-x-full md:translate-x-0 transition-transform duration-300 flex flex-col justify-between shadow-xl md:shadow-none">
        <div>
            <div class="p-8 pb-6 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-md border-2 border-pink-100 p-1 overflow-hidden">
                        <img src="{{ asset('img/panda.jpg') }}" alt="Logo Panda" class="w-full h-full object-cover rounded-full">
                    </div>
                    <div>
                        <h1 class="text-xl font-bold tracking-wider leading-none text-slate-800">PANDA</h1>
                        <h1 class="text-xs font-bold tracking-widest leading-none text-pink-500 mt-1">CASHIER</h1>
                    </div>
                </div>
                <button onclick="toggleSidebar()" class="md:hidden text-slate-400 hover:text-pink-500">
                    <i class="ph-bold ph-x text-2xl"></i>
                </button>
            </div>

            <nav class="px-4 space-y-2 mt-2">
                <a href="{{ route('kasir.dashboard') }}"
                    class="nav-item {{ request()->routeIs('kasir.dashboard') ? 'active' : '' }} flex items-center gap-3 px-4 py-3">
                    <i class="{{ request()->routeIs('kasir.dashboard') ? 'ph-fill' : 'ph-bold' }} ph-squares-four text-xl"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('transaksi.index') }}"
                    class="nav-item {{ request()->routeIs('transaksi.index') ? 'active' : '' }} flex items-center gap-3 px-4 py-3">
                    <i class="{{ request()->routeIs('transaksi.index') ? 'ph-fill' : 'ph-bold' }} ph-cash-register text-xl"></i>
                    <span>Transaksi Baru</span>
                </a>

                <a href="{{ route('kasir.produk.index') }}"
                    class="nav-item {{ request()->routeIs('kasir.produk.index') ? 'active' : '' }} flex items-center gap-3 px-4 py-3">
                    <i class="{{ request()->routeIs('kasir.produk.index') ? 'ph-fill' : 'ph-bold' }} ph-package text-xl"></i>
                    <span>Cek Stok</span>
                </a>
            </nav>
        </div>

        <div class="p-6">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold py-3 px-4 rounded-xl shadow-sm flex items-center justify-center gap-2 transition">
                    <i class="ph-bold ph-sign-out text-lg"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto bg-slate-50 relative">
        <div class="p-4 md:p-8">

            <div class="md:hidden flex justify-between items-center mb-6 bg-white p-4 rounded-2xl shadow-sm border border-slate-200">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-pink-100 flex items-center justify-center border border-pink-200 overflow-hidden">
                        <img src="{{ asset('img/panda.jpg') }}" alt="Logo" class="w-full h-full object-cover">
                    </div>
                    <span class="font-bold text-slate-700">Panda Lovely</span>
                </div>
                <button onclick="toggleSidebar()" class="text-slate-500 hover:text-pink-500">
                    <i class="ph-bold ph-list text-2xl"></i>
                </button>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-800">Halo, <span class="text-pink-500">{{ Auth::user()->name ?? 'Kasir' }}</span> </h2>
                    <p class="text-slate-500 mt-1 text-sm md:text-base">Selamat bertugas, semoga hari ini menyenangkan.</p>
                </div>

                <div class="bg-white px-5 py-2.5 rounded-full font-medium flex items-center shadow-sm border border-slate-200 text-slate-600 text-sm">
                    <i class="ph-fill ph-calendar-blank mr-2 text-pink-500 text-lg"></i>
                    {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

                <div class="bg-white px-5 py-4 rounded-xl border border-slate-100 shadow-sm">
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wide">Transaksi</span>
                    <div class="text-2xl font-bold text-slate-800 mt-1">{{ $transaksiHariIni ?? 0 }}</div>
                </div>

                <div class="bg-white px-5 py-4 rounded-xl border border-slate-100 shadow-sm">
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wide">Omset Hari Ini</span>
                    <div class="text-2xl font-bold text-pink-500 mt-1">
                        Rp {{ number_format($omsetHariIni ?? 0, 0, ',', '.') }}
                    </div>
                </div>

                <a href="{{ route('kasir.produk.index') }}" class="group bg-white px-5 py-4 rounded-xl border border-slate-100 shadow-sm flex items-center justify-between hover:border-pink-200 hover:bg-pink-50/30 transition-all cursor-pointer">
                    <div>
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wide group-hover:text-pink-400 transition">Shortcut</span>
                        <div class="text-lg font-bold text-slate-700 group-hover:text-pink-600 transition mt-1">Cek Stok Barang</div>
                    </div>
                    <i class="ph-bold ph-arrow-right text-slate-300 group-hover:text-pink-500 group-hover:translate-x-1 transition-transform"></i>
                </a>

            </div>

            <div class="bg-white border border-gray-200 rounded-lg p-5">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-gray-700">Riwayat Transaksi</h3>
                    <a href="{{ route('transaksi.riwayat') }}" class="text-sm text-blue-600 hover:underline">
                        Lihat Semua
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-100 text-gray-600">
                            <tr>
                                <th class="p-3 border-b">No. Invoice</th>
                                <th class="p-3 border-b">Kasir</th>
                                <th class="p-3 border-b">Total</th>
                                <th class="p-3 border-b">Status</th>
                                <th class="p-3 border-b text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @forelse($recentTransactions as $item)
                            <tr class="border-b hover:bg-gray-50">

                                <td class="p-3">
                                    <span class="font-medium">#{{ $item->invoice_code ?? $item->id }}</span>
                                    <div class="text-xs text-gray-400 mt-1">{{ $item->created_at->format('d/m/Y H:i') }}</div>
                                </td>

                                <td class="p-3">
                                    {{ $item->user->name ?? '-' }}
                                </td>

                                <td class="p-3 font-bold">
                                    Rp {{ number_format($item->total_price ?? 0, 0, ',', '.') }}
                                </td>

                                <td class="p-3">
                                    <span class="text-green-600 font-medium">Lunas</span>
                                </td>

                                <td class="p-3 text-center">
                                    <a href="{{ route('transaksi.struk', $item->id) }}" target="_blank" class="inline-block bg-gray-100 text-gray-600 px-3 py-1 rounded text-xs hover:bg-gray-200 border">
                                        Cetak
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-5 text-center text-gray-400">
                                    Belum ada data transaksi.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }
    </script>
</body>

</html>