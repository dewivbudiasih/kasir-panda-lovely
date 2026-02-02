<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk - Panda Lovely</title>

    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F8FAFC; /* Slate-50 */
        }

        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #F1F5F9; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94A3B8; }

        /* Sidebar Styling */
        .bg-sidebar {
            background-color: #FFF1F2; /* Rose-50 */
            border-right: 1px solid #FECDD3; /* Rose-200 */
        }

        .nav-item {
            color: #64748B;
            transition: all 0.2s ease-in-out;
            border-radius: 0.75rem;
            font-weight: 500;
        }

        .nav-item:hover:not(.active) {
            background-color: #FFE4E6; /* Rose-100 */
            color: #BE123C; /* Rose-700 */
        }

        .nav-item.active {
            background: linear-gradient(135deg, #EC4899 0%, #DB2777 100%);
            color: #FFFFFF;
            box-shadow: 0 4px 6px -1px rgba(236, 72, 153, 0.3);
            font-weight: 600;
        }

        /* Form Input Styling */
        .form-input {
            width: 100%;
            background-color: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            outline: none;
            transition: all 0.2s;
            color: #1E293B;
        }

        .form-input:focus {
            border-color: #EC4899;
            box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.1);
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 0.5rem;
        }

        /* Modal Transitions */
        .modal { transition: opacity 0.3s ease-in-out; }
        .modal-content { transition: transform 0.3s ease-in-out; }
        .modal.open { opacity: 1; pointer-events: auto; }
        .modal.open .modal-content { transform: scale(100%); }
        .modal.closed { opacity: 0; pointer-events: none; }
        .modal.closed .modal-content { transform: scale(95%); }
    </style>
</head>

<body class="text-slate-800 antialiased h-screen overflow-hidden flex">

    <aside class="w-64 bg-sidebar flex-col justify-between py-6 px-4 hidden md:flex h-full z-20 shadow-lg">
        <div>
            <div class="flex items-center gap-4 px-2 mb-10">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-md border-2 border-pink-100 overflow-hidden shrink-0">
                    <img src="{{ asset('img/panda.jpg') }}" onerror="this.src='https://ui-avatars.com/api/?name=Panda+Lovely&background=EC4899&color=fff'" alt="Logo" class="w-full h-full object-cover">
                </div>
                <div>
                    <h1 class="text-lg font-bold tracking-wide leading-none text-slate-800">PANDA</h1>
                    <h1 class="text-xs font-bold tracking-widest leading-none text-pink-500 mt-1">LOVELY</h1>
                </div>
            </div>

            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} flex items-center gap-3 px-4 py-3">
                    <i class="ph-fill ph-squares-four text-xl"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('produk.index') }}" class="nav-item {{ request()->routeIs('produk.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3">
                    <i class="ph-fill ph-package text-xl"></i>
                    <span>Produk</span>
                </a>
                </nav>
        </div>

        <div>
            <form action="#" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-white border border-rose-100 text-rose-500 rounded-xl hover:bg-rose-50 hover:text-rose-600 transition font-medium shadow-sm group">
                    <i class="ph-bold ph-sign-out text-lg group-hover:-translate-x-1 transition-transform"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-full relative overflow-hidden bg-slate-50">
        
        <div class="md:hidden bg-white p-4 flex justify-between items-center shadow-sm">
            <span class="font-bold text-pink-500">Panda Lovely</span>
            <button class="text-slate-600"><i class="ph-bold ph-list text-2xl"></i></button>
        </div>

        <div class="flex-1 overflow-y-auto custom-scrollbar p-4 md:p-8">
            
            <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800">Manajemen Produk</h2>
                    <p class="text-slate-500 text-sm mt-1">Kelola stok, harga, dan kategori produk di sini.</p>
                </div>
                <div class="flex items-center gap-2 text-sm text-slate-500 bg-white px-4 py-2 rounded-full shadow-sm border border-slate-100">
                    <i class="ph-fill ph-calendar-blank text-pink-500"></i>
                    {{ date('d F Y') }}
                </div>
            </div>

            @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm mb-6 flex items-start gap-3">
                <i class="ph-fill ph-warning-circle text-xl mt-0.5"></i>
                <div>
                    <p class="font-bold">Terjadi Kesalahan</p>
                    <ul class="list-disc pl-4 mt-1 text-sm">
                        @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            </div>
            @endif

            @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm mb-6 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <i class="ph-fill ph-check-circle text-xl"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800"><i class="ph-bold ph-x"></i></button>
            </div>
            @endif

            <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 mb-6 flex flex-col md:flex-row gap-4 justify-between items-center">
                <form action="{{ route('produk.index') }}" method="GET" class="w-full md:w-96 relative">
                    <i class="ph-bold ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode atau nama produk..." 
                        class="w-full bg-slate-50 border border-slate-200 pl-10 pr-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition text-sm">
                </form>

                <button onclick="openModal('modalTambah')" 
                    class="w-full md:w-auto bg-pink-500 hover:bg-pink-600 text-white px-5 py-2.5 rounded-xl font-medium shadow-lg shadow-pink-500/30 flex items-center justify-center gap-2 transition hover:-translate-y-0.5">
                    <i class="ph-bold ph-plus"></i> Tambah Produk
                </button>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-pink-50/50 text-slate-700 font-bold uppercase text-xs tracking-wider border-b border-pink-100">
                            <tr>
                                <th class="p-4 w-24">Kode</th>
                                <th class="p-4">Nama Produk</th>
                                <th class="p-4">Kategori</th>
                                <th class="p-4">Stok</th>
                                <th class="p-4">Harga</th>
                                <th class="p-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($products as $item)
                            <tr class="hover:bg-slate-50 transition duration-150">
                                <td class="p-4 font-mono text-xs font-semibold text-slate-500">{{ $item->code }}</td>
                                <td class="p-4">
                                    <div class="font-semibold text-slate-800">{{ $item->name }}</div>
                                    <div class="text-xs text-slate-400 mt-0.5 truncate max-w-[200px]">{{ $item->keterangan }}</div>
                                </td>
                                <td class="p-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium bg-pink-100 text-pink-700 border border-pink-200">
                                        <i class="ph-fill ph-tag"></i> {{ $item->category->nama_kategori ?? '-' }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    @if($item->stock <= 5)
                                        <span class="text-red-600 font-bold flex items-center gap-1 bg-red-50 px-2 py-1 rounded w-max">
                                            <i class="ph-fill ph-warning"></i> {{ $item->stock }}
                                        </span>
                                    @else
                                        <span class="font-medium text-slate-700">{{ $item->stock }}</span>
                                    @endif
                                </td>
                                <td class="p-4 font-medium text-slate-800">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="p-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        <button onclick="openModal('modalEdit{{ $item->id }}')" 
                                            class="w-8 h-8 rounded-lg flex items-center justify-center text-amber-500 bg-amber-50 hover:bg-amber-100 transition border border-amber-200" title="Edit">
                                            <i class="ph-fill ph-pencil-simple"></i>
                                        </button>

                                        <form action="{{ route('produk.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center text-red-500 bg-red-50 hover:bg-red-100 transition border border-red-200" title="Hapus">
                                                <i class="ph-fill ph-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <div id="modalEdit{{ $item->id }}" class="modal closed fixed inset-0 z-50 flex items-center justify-center p-4">
                                <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity" onclick="closeModal('modalEdit{{ $item->id }}')"></div>
                                <div class="modal-content bg-white w-full max-w-lg rounded-2xl shadow-2xl z-10 overflow-hidden relative flex flex-col max-h-[90vh]">
                                    <div class="flex justify-between items-center px-6 py-4 border-b border-slate-100 bg-slate-50">
                                        <h3 class="font-bold text-lg text-slate-800 flex items-center gap-2">
                                            <i class="ph-fill ph-pencil-circle text-amber-500 text-xl"></i> Edit Produk
                                        </h3>
                                        <button onclick="closeModal('modalEdit{{ $item->id }}')" class="text-slate-400 hover:text-slate-600 rounded-full p-1 hover:bg-slate-200 transition">
                                            <i class="ph-bold ph-x text-lg"></i>
                                        </button>
                                    </div>
                                    
                                    <form action="{{ route('produk.update', $item->id) }}" method="POST" class="flex flex-col flex-1 overflow-hidden">
                                        @csrf @method('PUT')
                                        <div class="p-6 overflow-y-auto custom-scrollbar space-y-4">
                                            <div>
                                                <label class="form-label">Kode Produk</label>
                                                <input type="text" name="code" value="{{ $item->code }}" class="form-input bg-slate-50 text-slate-500 cursor-not-allowed" readonly>
                                            </div>
                                            <div>
                                                <label class="form-label">Nama Produk</label>
                                                <input type="text" name="name" value="{{ $item->name }}" class="form-input" required>
                                            </div>
                                            <div class="grid grid-cols-2 gap-4">
                                                <div>
                                                    <label class="form-label">Kategori</label>
                                                    <div class="relative">
                                                        <select name="category_id" class="form-input appearance-none cursor-pointer">
                                                            @foreach($categories as $kat)
                                                            <option value="{{ $kat->id_kategori }}" {{ $item->category_id == $kat->id_kategori ? 'selected' : '' }}>
                                                                {{ $kat->nama_kategori }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        <i class="ph-bold ph-caret-down absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="form-label">Stok</label>
                                                    <input type="number" name="stock" value="{{ $item->stock }}" class="form-input" required>
                                                </div>
                                            </div>
                                            <div>
                                                <label class="form-label">Harga (Rp)</label>
                                                <input type="number" name="price" value="{{ $item->price }}" class="form-input" required>
                                            </div>
                                            <div>
                                                <label class="form-label">Keterangan</label>
                                                <textarea name="keterangan" rows="3" class="form-input resize-none">{{ $item->keterangan }}</textarea>
                                            </div>
                                        </div>

                                        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
                                            <button type="button" onclick="closeModal('modalEdit{{ $item->id }}')" class="px-4 py-2 rounded-xl text-slate-600 font-medium hover:bg-slate-200 transition text-sm">Batal</button>
                                            <button type="submit" class="px-4 py-2 rounded-xl bg-amber-500 text-white font-medium hover:bg-amber-600 shadow-lg shadow-amber-500/20 transition text-sm">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="6" class="p-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-slate-400">
                                        <i class="ph-duotone ph-package text-6xl mb-3 text-slate-300"></i>
                                        <p class="font-medium text-lg">Belum ada data produk.</p>
                                        <p class="text-sm">Silakan tambahkan produk baru.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($products->hasPages())
                <div class="px-4 py-3 border-t border-slate-100 bg-slate-50">
                    {{ $products->links() }}
                </div>
                @endif
            </div>

        </div>
    </main>

    <div id="modalTambah" class="modal closed fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity" onclick="closeModal('modalTambah')"></div>
        <div class="modal-content bg-white w-full max-w-2xl rounded-2xl shadow-2xl z-10 overflow-hidden relative flex flex-col max-h-[90vh]">
            <div class="flex justify-between items-center px-6 py-4 border-b border-slate-100 bg-slate-50">
                <h3 class="font-bold text-lg text-slate-800 flex items-center gap-2">
                    <i class="ph-fill ph-plus-circle text-pink-500 text-xl"></i> Tambah Produk Baru
                </h3>
                <button onclick="closeModal('modalTambah')" class="text-slate-400 hover:text-red-500 rounded-full p-1 hover:bg-red-50 transition">
                    <i class="ph-bold ph-x text-lg"></i>
                </button>
            </div>
            
            <form action="{{ route('produk.store') }}" method="POST" class="flex flex-col flex-1 overflow-hidden">
                @csrf
                <div class="p-6 overflow-y-auto custom-scrollbar space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="form-label">Kode Produk</label>
                            <input type="text" name="code" placeholder="Cth: PND-001" class="form-input" required>
                        </div>
                        <div>
                            <label class="form-label">Kategori</label>
                            <div class="relative">
                                <select name="category_id" class="form-input appearance-none cursor-pointer" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    @foreach($categories as $cat) 
                                        <option value="{{ $cat->id_kategori }}">{{ $cat->nama_kategori }}</option> 
                                    @endforeach
                                </select>
                                <i class="ph-bold ph-caret-down absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="name" placeholder="Masukkan nama produk..." class="form-input" required>
                    </div>

                    <div>
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" rows="2" class="form-input resize-none" placeholder="Deskripsi singkat produk..."></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="form-label">Harga (Rp)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 font-bold text-sm">Rp</span>
                                <input type="number" name="price" class="form-input pl-10" placeholder="0" required>
                            </div>
                        </div>
                        <div>
                            <label class="form-label">Stok Awal</label>
                            <input type="number" name="stock" class="form-input" placeholder="0" required>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
                    <button type="button" onclick="closeModal('modalTambah')" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-100 transition text-sm">Batal</button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-pink-500 text-white font-medium hover:bg-pink-600 shadow-lg shadow-pink-500/30 transition flex items-center gap-2 text-sm">
                        <i class="ph-bold ph-check"></i> Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.remove('closed');
            modal.classList.add('open');
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.remove('open');
            modal.classList.add('closed');
        }
        
        // Tutup modal dengan tombol ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                document.querySelectorAll('.modal.open').forEach(modal => {
                    closeModal(modal.id);
                });
            }
        });
    </script>
</body>
</html>