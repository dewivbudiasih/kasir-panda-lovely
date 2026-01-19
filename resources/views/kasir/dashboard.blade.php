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

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #F1F5F9; }
        ::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94A3B8; }
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
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-800">Halo, <span class="text-pink-500">{{ Auth::user()->name ?? 'Kasir' }}</span>! 👋</h2>
                    <p class="text-slate-500 mt-1 text-sm md:text-base">Selamat bertugas, semoga hari ini menyenangkan.</p>
                </div>

                <div class="bg-white px-5 py-2.5 rounded-full font-medium flex items-center shadow-sm border border-slate-200 text-slate-600 text-sm">
                    <i class="ph-fill ph-calendar-blank mr-2 text-pink-500 text-lg"></i>
                    {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 flex items-center justify-between hover:shadow-md transition">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Transaksi Hari Ini</p>
                        <h3 class="text-3xl font-bold text-slate-800">{{ $transaksiHariIni ?? 0 }}</h3>
                    </div>
                    <div class="h-12 w-12 rounded-xl bg-pink-50 flex items-center justify-center text-pink-500 text-xl border border-pink-100">
                        <i class="ph-fill ph-receipt"></i>
                    </div>
                </div>

                <div class="bg-pink-500 p-6 rounded-2xl shadow-lg shadow-pink-500/30 text-white flex items-center justify-between transform hover:-translate-y-1 transition duration-300">
                    <div>
                        <p class="text-xs font-bold text-pink-100 uppercase tracking-wider mb-1 opacity-90">Omset Hari Ini</p>
                        <h3 class="text-2xl md:text-3xl font-bold">Rp {{ number_format($omsetHariIni ?? 0, 0, ',', '.') }}</h3>
                    </div>
                    <div class="h-12 w-12 rounded-xl bg-white/20 flex items-center justify-center text-white text-xl backdrop-blur-sm">
                        <i class="ph-fill ph-wallet"></i>
                    </div>
                </div>

                <a href="{{ route('kasir.produk.index') }}" class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 flex items-center justify-between hover:border-pink-300 hover:shadow-md group transition cursor-pointer">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1 group-hover:text-pink-500 transition">Shortcut</p>
                        <h3 class="text-lg font-bold text-slate-800 group-hover:text-pink-600 transition">Cek Stok Barang</h3>
                    </div>
                    <div class="h-12 w-12 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 text-xl group-hover:bg-pink-50 group-hover:text-pink-500 transition">
                        <i class="ph-bold ph-magnifying-glass"></i>
                    </div>
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8 min-h-[400px]">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                        <i class="ph-fill ph-clock-counter-clockwise text-pink-500"></i> Riwayat Terakhir
                    </h3>
                    <a href="{{ route('transaksi.riwayat') }}" class="text-sm text-pink-500 font-bold hover:text-pink-700 hover:underline flex items-center gap-1 transition">
                        Lihat Semua <i class="ph-bold ph-arrow-right"></i>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <thead>
                            <tr class="text-left text-slate-500 text-xs font-bold uppercase tracking-wider border-b border-slate-100 bg-slate-50">
                                <th class="py-3 px-4 rounded-tl-lg">ID Struk</th>
                                <th class="py-3 px-4">Waktu</th>
                                <th class="py-3 px-4">Kasir</th>
                                <th class="py-3 px-4">Total</th>
                                <th class="py-3 px-4 text-center">Status</th>
                                <th class="py-3 px-4 text-right rounded-tr-lg">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-medium text-slate-600">
                            @forelse($recentTransactions as $item)
                            <tr class="border-b border-slate-50 last:border-0 hover:bg-slate-50 transition group">
                                <td class="py-4 px-4 text-slate-800 font-bold font-mono">#{{ $item->invoice_code ?? $item->id }}</td>
                                <td class="py-4 px-4">{{ $item->created_at->format('H:i') }}</td>
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-full bg-pink-100 flex items-center justify-center text-xs text-pink-600 font-bold border border-pink-200">
                                            {{ substr($item->user->name ?? 'K', 0, 1) }}
                                        </div>
                                        <span class="truncate max-w-[100px]">{{ $item->user->name ?? 'Kasir' }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4 font-bold text-slate-700">
                                    Rp {{ number_format($item->total_price ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <span class="bg-green-100 text-green-700 border border-green-200 py-1 px-3 rounded-full text-[10px] font-bold uppercase tracking-wide">LUNAS</span>
                                </td>
                                <td class="py-4 px-4 text-right">
                                    <a href="{{ route('transaksi.struk', $item->id) }}" target="_blank" class="text-slate-400 hover:text-pink-500 bg-slate-100 hover:bg-pink-50 border border-transparent hover:border-pink-200 p-2 rounded-lg transition inline-block" title="Cetak Struk">
                                        <i class="ph-fill ph-printer text-lg"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-20">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <div class="bg-slate-50 p-4 rounded-full">
                                            <i class="ph-duotone ph-receipt text-4xl text-slate-300"></i>
                                        </div>
                                        <p class="text-slate-500 font-medium">Belum ada transaksi hari ini.</p>
                                    </div>
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