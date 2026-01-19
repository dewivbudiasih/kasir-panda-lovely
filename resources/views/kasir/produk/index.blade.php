<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Barang - Kasir Panda</title>
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
                   class="nav-item active flex items-center gap-3 px-4 py-3">
                    <i class="ph-fill ph-package text-xl"></i>
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
                    <h2 class="text-2xl font-bold text-slate-800">Stok Barang</h2>
                    <p class="text-slate-500 text-sm mt-1">Cek ketersediaan dan harga barang secara realtime.</p>
                </div>
                
                <form action="{{ route('kasir.produk.index') }}" method="GET" class="w-full md:w-96 relative group">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau kode barang..."
                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-700 placeholder:text-slate-400 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 outline-none transition shadow-sm">
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400 group-focus-within:text-pink-500 transition">
                        <i class="ph-bold ph-magnifying-glass text-lg"></i>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden min-h-[500px]">
                <div class="overflow-x-auto">
                    <table class="w-full text-left whitespace-nowrap">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-xs font-bold text-slate-500 uppercase tracking-wider">
                                <th class="py-4 px-6 w-24">Kode</th>
                                <th class="py-4 px-6">Produk</th>
                                <th class="py-4 px-6">Keterangan</th>
                                <th class="py-4 px-6">Kategori</th>
                                <th class="py-4 px-6 text-center">Stok</th>
                                <th class="py-4 px-6 text-right">Harga</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse($produks as $item)
                            <tr class="hover:bg-slate-50 transition duration-150 group">
                                <td class="py-4 px-6">
                                    <span class="font-mono text-xs font-semibold text-slate-600 bg-slate-100 px-2 py-1 rounded-md">
                                        {{ $item->code ?? '-' }}
                                    </span>
                                </td>

                                <td class="py-4 px-6">
                                    <span class="font-bold text-slate-800 text-base block mb-0.5">
                                        {{ $item->name }}
                                    </span>
                                </td>

                                <td class="py-4 px-6">
                                    <span class="text-slate-500 text-xs max-w-xs truncate block">
                                        {{ $item->keterangan ?? '-' }}
                                    </span>
                                </td>

                                <td class="py-4 px-6">
                                    @if($item->category)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pink-50 text-pink-700 border border-pink-100">
                                        {{ $item->category->nama_kategori ?? $item->category->name }}
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-500">
                                        Umum
                                    </span>
                                    @endif
                                </td>

                                <td class="py-4 px-6 text-center">
                                    @if($item->stock <= 5)
                                        <span class="text-red-600 font-bold bg-red-50 px-2 py-1 rounded-md border border-red-100 text-xs">
                                            Sisa {{ $item->stock }}
                                        </span>
                                    @else
                                        <span class="text-slate-700 font-bold bg-slate-100 px-3 py-1 rounded-md text-xs">
                                            {{ $item->stock }}
                                        </span>
                                    @endif
                                </td>

                                <td class="py-4 px-6 text-right">
                                    <span class="font-bold text-slate-700 text-base">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-slate-400">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="bg-slate-50 p-4 rounded-full">
                                            <i class="ph-duotone ph-package text-4xl text-slate-300"></i>
                                        </div>
                                        <span class="font-medium">Data barang tidak ditemukan.</span>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($produks->hasPages())
                <div class="p-4 border-t border-slate-200 bg-slate-50">
                    {{ $produks->links() }}
                </div>
                @endif
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