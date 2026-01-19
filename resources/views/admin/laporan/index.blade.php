<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - Panda Lovely</title>
    {{-- Menggunakan CDN Tailwind standar agar tampilan rapi --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
        /* Style sederhana untuk Modal */
        .modal { visibility: hidden; opacity: 0; transition: all 0.2s ease-in-out; }
        .modal.active { visibility: visible; opacity: 1; }
        .modal-content { transform: scale(0.95); transition: all 0.2s ease-in-out; }
        .modal.active .modal-content { transform: scale(1); }

        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 10px; }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-pink-100 p-6 shadow-lg flex flex-col h-full z-20 relative">
            <div class="flex items-center gap-3 mb-10">
                <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shadow-sm border-2 border-pink-200 overflow-hidden">
                    <img src="{{ asset('img/panda.jpg') }}" onerror="this.src='https://ui-avatars.com/api/?name=Panda+Lovely&background=pink&color=white'" alt="Logo" class="w-full h-full object-cover">
                </div>
                <div class="flex flex-col">
                    <h1 class="text-xl font-bold text-pink-600 leading-none tracking-wide">PANDA</h1>
                    <span class="text-xs font-bold text-pink-400 leading-none tracking-wide">LOVELY</span>
                </div>
            </div>

            <nav class="space-y-2 flex-1 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-pink-200 rounded-xl transition font-medium">
                    <i class="ph ph-squares-four text-xl"></i> Dashboard
                </a>
                
                <a href="{{ route('laporan.index') }}" class="flex items-center gap-3 p-3 bg-white text-pink-600 font-bold rounded-xl shadow-sm transition">
                    <i class="ph-fill ph-file-text text-xl"></i> Laporan
                </a>
            </nav>

            <div class="mt-auto pt-6 border-t border-pink-200/50">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 bg-white hover:bg-pink-50 text-pink-600 font-bold py-3 px-4 rounded-xl shadow-sm border border-pink-200 transition">
                        <i class="ph-bold ph-sign-out text-lg"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 p-8 overflow-y-auto relative h-full">
            <header class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Laporan Penjualan</h2>
                    <p class="text-gray-500 text-sm">Pantau performa tokomu di sini.</p>
                </div>
                <div class="flex items-center gap-2 bg-white px-4 py-2 rounded-full shadow-sm border border-gray-100">
                    <div class="w-8 h-8 rounded-full bg-pink-100 flex items-center justify-center text-pink-600 font-bold text-xs">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                    <span class="text-sm font-medium text-gray-600">{{ Auth::user()->name ?? 'Admin' }}</span>
                </div>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                <div class="md:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <form method="GET" action="{{ route('laporan.index') }}" class="flex items-end gap-4 flex-wrap">
                        <div class="flex-1 min-w-[150px]">
                            <label class="block text-xs text-gray-400 mb-1 font-medium">Mulai Tanggal</label>
                            <input type="date" name="tgl_mulai" value="{{ $tanggal_mulai ?? date('Y-m-d') }}" 
                                class="w-full border border-gray-200 bg-gray-50 p-2.5 rounded-lg text-sm outline-pink-400 focus:bg-white transition">
                        </div>
                        <div class="flex-1 min-w-[150px]">
                            <label class="block text-xs text-gray-400 mb-1 font-medium">Sampai Tanggal</label>
                            <input type="date" name="tgl_selesai" value="{{ $tanggal_selesai ?? date('Y-m-d') }}" 
                                class="w-full border border-gray-200 bg-gray-50 p-2.5 rounded-lg text-sm outline-pink-400 focus:bg-white transition">
                        </div>
                        
                        <button type="submit" class="bg-pink-500 text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-pink-600 transition shadow-md shadow-pink-200 flex items-center gap-2">
                            <i class="ph-bold ph-funnel"></i> Filter
                        </button>

                        {{-- Tombol PDF --}}
                        <button type="submit" formaction="{{ route('laporan.cetakPdf') }}" 
                            class="bg-gray-800 text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-900 transition shadow-md shadow-gray-300 flex items-center gap-2">
                            <i class="ph-bold ph-printer"></i> PDF
                        </button>
                    </form>
                </div>

                <div class="bg-gradient-to-br from-pink-500 to-pink-600 p-6 rounded-2xl shadow-lg shadow-pink-200 text-white flex flex-col justify-center relative overflow-hidden">
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-white opacity-10 rounded-full"></div>
                    <p class="text-sm opacity-90 mb-1 font-medium">Total Pendapatan</p>
                    <h3 class="text-3xl font-bold tracking-tight">Rp {{ number_format($total_pendapatan ?? 0, 0, ',', '.') }}</h3>
                    <p class="text-xs opacity-70 mt-2">Periode terpilih</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="p-4 font-semibold pl-6">Tanggal</th>
                            <th class="p-4 font-semibold">No. Transaksi</th>
                            <th class="p-4 font-semibold">Total</th>
                            <th class="p-4 font-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        @forelse($laporan as $row)
                        <tr class="hover:bg-pink-50/30 transition group">
                            <td class="p-4 pl-6 text-gray-600">
                                <div class="font-medium text-gray-800">{{ $row->created_at->format('d/m/Y') }}</div>
                                <div class="text-xs text-gray-400">{{ $row->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td class="p-4 font-mono font-bold text-gray-800">#TRX-{{ $row->id }}</td>
                            <td class="p-4 font-bold text-green-600">Rp {{ number_format($row->total_price ?? 0, 0, ',', '.') }}</td>
                            <td class="p-4 text-center">
                                <button onclick="openModal('modal-{{ $row->id }}')" class="bg-white border border-pink-200 text-pink-500 hover:bg-pink-500 hover:text-white px-4 py-1.5 rounded-lg text-xs font-medium transition shadow-sm cursor-pointer">
                                    Detail
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center text-gray-400">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center">
                                        <i class="ph ph-files text-3xl opacity-40"></i>
                                    </div>
                                    <span class="text-sm">Tidak ada transaksi pada periode ini.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                @if($laporan->hasPages())
                <div class="p-4 border-t border-gray-100 bg-gray-50/50">
                    {{ $laporan->withQueryString()->links() }}
                </div>
                @endif
            </div>
        </main>
    </div>

    @foreach($laporan as $row)
    <div id="modal-{{ $row->id }}" class="modal fixed inset-0 z-50 flex items-center justify-center p-4">
        {{-- Overlay hitam --}}
        <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal('modal-{{ $row->id }}')"></div>

        <div class="modal-content bg-white w-full max-w-2xl rounded-2xl shadow-2xl relative z-10 flex flex-col max-h-[90vh]">

            <div class="flex justify-between items-start p-6 border-b border-gray-100">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Detail Transaksi</h3>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="bg-green-100 text-green-600 text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wide">Sukses</span>
                        <span class="text-sm text-gray-400 font-mono">#TRX-{{ $row->id }}</span>
                    </div>
                </div>
                <button onclick="closeModal('modal-{{ $row->id }}')" class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 hover:bg-red-50 hover:text-red-500 transition cursor-pointer">
                    <i class="ph-bold ph-x"></i>
                </button>
            </div>

            <div class="p-6 overflow-y-auto custom-scrollbar">
                <div class="flex justify-between mb-6 text-sm bg-gray-50 p-4 rounded-xl border border-gray-100">
                    <div>
                        <p class="text-gray-400 text-xs uppercase font-bold mb-1">Waktu</p>
                        <p class="font-medium text-gray-700">{{ $row->created_at->format('l, d F Y') }}</p>
                        <p class="text-gray-500 text-xs">{{ $row->created_at->format('H:i') }} WIB</p>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-400 text-xs uppercase font-bold mb-1">Kasir</p>
                        {{-- Menggunakan null coalescing (??) agar tidak error jika user dihapus --}}
                        <p class="font-medium text-gray-700">{{ $row->user->name ?? 'Admin' }}</p>
                    </div>
                </div>

                <div class="border border-gray-100 rounded-xl overflow-hidden mb-4">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-bold">
                            <tr>
                                <th class="py-3 px-4 text-left">Produk</th>
                                <th class="py-3 px-4 text-center">Qty</th>
                                <th class="py-3 px-4 text-right">Harga</th>
                                <th class="py-3 px-4 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            {{-- PENTING: Menggunakan $row->details --}}
                            @foreach($row->details as $item)
                            <tr>
                                <td class="py-3 px-4">
                                    <span class="font-medium text-gray-800">
                                        {{-- Cek apakah produk masih ada di database --}}
                                        {{ $item->product->name ?? 'Produk tidak ditemukan' }}
                                    </span>
                                    @if(!$item->product)
                                      <span class="text-[10px] text-red-500 bg-red-50 px-1 rounded ml-1">(Dihapus)</span>
                                    @endif
                                </td>
                                {{-- PERBAIKAN: Menggunakan 'quantity' bukan 'qty' sesuai standar DB Laravel --}}
                                <td class="py-3 px-4 text-center text-gray-500 font-mono">
                                    x{{ $item->quantity ?? $item->qty }}
                                </td>
                                <td class="py-3 px-4 text-right text-gray-500">
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </td>
                                <td class="py-3 px-4 text-right font-bold text-gray-700">
                                    {{-- Hitung subtotal manual agar aman --}}
                                    Rp {{ number_format($item->price * ($item->quantity ?? $item->qty), 0, ',', '.') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-end">
                    <div class="w-full md:w-1/2 space-y-3">
                        <div class="flex justify-between items-center pt-2 border-t border-gray-100">
                            <span class="font-bold text-lg text-gray-800">Total Bayar</span>
                            <span class="font-bold text-xl text-pink-600">Rp {{ number_format($row->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-5 border-t border-gray-100 bg-gray-50 rounded-b-2xl flex justify-end gap-3">
                <button onclick="closeModal('modal-{{ $row->id }}')" class="px-5 py-2.5 rounded-xl bg-white border border-gray-200 text-gray-600 text-sm font-semibold hover:bg-gray-100 transition shadow-sm cursor-pointer">
                    Tutup
                </button>
            </div>
        </div>
    </div>
    @endforeach

    <script>
        function openModal(id) {
            const modal = document.getElementById(id);
            if(modal) {
                modal.classList.add('active');
                document.body.style.overflow = 'hidden'; 
            }
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            if(modal) {
                modal.classList.remove('active');
                document.body.style.overflow = 'auto'; 
            }
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        }
    </script>
</body>
</html>