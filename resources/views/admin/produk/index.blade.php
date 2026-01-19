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

        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #F1F5F9; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94A3B8; }
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

        .form-input[readonly] {
            background-color: #F8FAFC;
            color: #64748B;
        }

        .form-label {
            display: block;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #475569; 
            margin-bottom: 0.4rem;
        }

        .modal { transition: opacity 0.3s ease-in-out; }
        body.modal-active { overflow: hidden !important; }
    </style>
</head>

<body class="text-slate-800 antialiased">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-sidebar flex flex-col justify-between py-6 px-4 hidden md:flex h-full relative z-10">
            <div>
                <div class="flex items-center gap-4 px-4 mb-10">
                    <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-md border-2 border-pink-100 p-1 overflow-hidden">
                        <img src="{{ asset('img/panda.jpg') }}" alt="Logo Panda" class="w-full h-full object-cover rounded-full">
                    </div>

                    <div>
                        <h1 class="text-xl font-bold tracking-wider leading-none text-slate-800">PANDA</h1>
                        <h1 class="text-sm font-bold tracking-widest leading-none text-pink-500 mt-1">LOVELY</h1>
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
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-white border border-slate-200 text-slate-600 rounded-xl hover:bg-slate-100 hover:text-slate-900 transition font-medium shadow-sm">
                        <i class="ph-bold ph-sign-out text-lg"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col h-screen overflow-y-auto bg-white relative">
            <div class="p-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800">Manajemen Produk</h2>
                        <p class="text-slate-500 text-sm mt-1">Kelola stok, harga, dan keterangan barang.</p>
                    </div>
                    <div class="bg-white border border-slate-200 px-4 py-2 rounded-full text-sm font-medium text-slate-600 shadow-sm flex items-center gap-2">
                        <i class="ph-fill ph-calendar text-pink-500"></i> {{ date('d F Y') }}
                    </div>
                </div>

                @if ($errors->any())
                <div class="bg-red-50 border border-red-100 text-red-600 p-4 rounded-xl mb-6">
                    <ul class="list-disc pl-5 text-sm space-y-1">
                        @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
                @endif

                @if(session('success'))
                <div class="bg-green-50 border border-green-100 text-green-600 p-4 rounded-xl mb-6 flex justify-between items-center shadow-sm">
                    <div class="flex items-center gap-2">
                        <i class="ph-fill ph-check-circle text-xl"></i>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.style.display='none'" class="text-green-400 hover:text-green-700"><i class="ph-bold ph-x"></i></button>
                </div>
                @endif

                <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
                    <form action="{{ route('produk.index') }}" method="GET" class="relative w-full md:w-96 group">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau kode produk..."
                            class="w-full pl-5 pr-12 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 placeholder:text-slate-400 focus:bg-white focus:ring-2 focus:ring-pink-400 focus:border-pink-400 outline-none transition shadow-sm">
                        <button type="submit" class="absolute inset-y-0 right-0 flex items-center px-4 text-slate-400 hover:text-pink-500 transition cursor-pointer">
                            <i class="ph-bold ph-magnifying-glass text-lg"></i>
                        </button>
                    </form>

                    <button onclick="toggleModal('modalTambah')" class="bg-pink-500 text-white px-6 py-3 rounded-xl font-medium shadow-lg shadow-pink-500/30 hover:bg-pink-600 hover:shadow-pink-600/40 transition flex items-center gap-2 transform hover:-translate-y-0.5">
                        <i class="ph-bold ph-plus"></i> Tambah Produk
                    </button>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-xs text-slate-500 font-bold uppercase tracking-wider bg-slate-50 border-b border-slate-200">
                                    <th class="py-4 px-6">Kode</th>
                                    <th class="py-4 px-6">Produk</th>
                                    <th class="py-4 px-6">Keterangan</th>
                                    <th class="py-4 px-6">Kategori</th>
                                    <th class="py-4 px-6">Stok</th>
                                    <th class="py-4 px-6">Harga</th>
                                    <th class="py-4 px-6 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-slate-600 divide-y divide-slate-100">
                                @forelse($products as $item)
                                <tr class="hover:bg-slate-50 transition group">
                                    <td class="py-4 px-6 font-mono text-xs font-semibold text-slate-600 bg-slate-50/50 w-24">
                                        {{ $item->code }}
                                    </td>
                                    <td class="py-4 px-6 font-bold text-slate-800 text-base">
                                        {{ $item->name }}
                                    </td>
                                    <td class="py-4 px-6 text-slate-500 text-sm max-w-xs truncate">
                                        {{ $item->keterangan ?? '-' }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pink-50 text-pink-700 border border-pink-100">
                                            {{ $item->category->nama_kategori ?? 'Umum' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        @if($item->stock <= 5)
                                            <span class="inline-flex items-center gap-1 text-red-600 font-bold bg-red-50 px-2 py-1 rounded-md text-xs border border-red-100">
                                            <i class="ph-fill ph-warning"></i> {{ $item->stock }}
                                            </span>
                                        @else
                                            <span class="text-slate-600 font-medium">{{ $item->stock }}</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 font-bold text-slate-700">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="flex justify-center gap-2">
                                            <button onclick="toggleModal('modalEdit{{ $item->id }}')" class="w-8 h-8 flex items-center justify-center text-yellow-600 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition border border-yellow-100" title="Edit">
                                                <i class="ph-fill ph-pencil-simple"></i>
                                            </button>
                                            <form action="{{ route('produk.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus produk ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="w-8 h-8 flex items-center justify-center text-red-500 bg-red-50 rounded-lg hover:bg-red-100 transition border border-red-100" title="Hapus">
                                                    <i class="ph-fill ph-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <div id="modalEdit{{ $item->id }}" class="modal opacity-0 pointer-events-none fixed inset-0 z-50 flex items-center justify-center">
                                    <div class="modal-overlay absolute inset-0 bg-slate-900/50 backdrop-blur-sm"></div>
                                    <div class="modal-container bg-white w-full max-w-2xl mx-4 rounded-2xl shadow-2xl z-50 overflow-hidden transform scale-95 transition-all duration-300 flex flex-col max-h-[90vh]">
                                        <div class="flex-none flex justify-between items-center px-6 py-4 border-b border-slate-100 bg-slate-50">
                                            <h3 class="text-lg font-bold text-slate-800">Edit Produk</h3>
                                            <button type="button" onclick="toggleModal('modalEdit{{ $item->id }}')" class="text-slate-400 hover:text-red-500 transition rounded-full p-1 hover:bg-red-50"><i class="ph-bold ph-x text-xl"></i></button>
                                        </div>
                                        <form action="{{ route('produk.update', $item->id) }}" method="POST" class="flex flex-col flex-1 min-h-0">
                                            @csrf @method('PUT')
                                            <div class="flex-1 overflow-y-auto p-6 custom-scrollbar">
                                                <div class="space-y-5">
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                                        <div><label class="form-label">Kode Produk</label><input type="text" name="code" value="{{ $item->code }}" class="form-input" readonly></div>
                                                        <div>
                                                            <label class="form-label">Kategori</label>
                                                            <div class="relative">
                                                                <select name="category_id" class="form-input appearance-none cursor-pointer pr-10">
                                                                    @foreach($categories as $kat)
                                                                    <option value="{{ $kat->id_kategori }}" {{ $item->category_id == $kat->id_kategori ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-slate-500"><i class="ph-bold ph-caret-down"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div><label class="form-label">Nama Produk</label><input type="text" name="name" value="{{ $item->name }}" class="form-input font-medium text-slate-800"></div>
                                                    <div><label class="form-label">Keterangan</label><textarea name="keterangan" rows="3" class="form-input resize-none">{{ $item->keterangan }}</textarea></div>
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                                        <div><label class="form-label">Harga (Rp)</label>
                                                            <div class="relative"><span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 font-bold text-sm">Rp</span><input type="number" name="price" value="{{ $item->price }}" class="form-input pl-10 font-medium"></div>
                                                        </div>
                                                        <div><label class="form-label">Stok</label><input type="number" name="stock" value="{{ $item->stock }}" class="form-input font-medium"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-none px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
                                                <button type="button" onclick="toggleModal('modalEdit{{ $item->id }}')" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-600 font-medium hover:bg-slate-100 transition text-sm">Batal</button>
                                                <button type="submit" class="px-5 py-2.5 rounded-xl bg-pink-500 text-white font-medium hover:bg-pink-600 shadow-lg shadow-pink-500/30 transition flex items-center gap-2 text-sm"><i class="ph-bold ph-floppy-disk"></i> Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="7" class="py-12 text-center text-slate-400">
                                        <div class="flex flex-col items-center gap-3">
                                            <div class="bg-slate-50 p-4 rounded-full"><i class="ph-duotone ph-package text-4xl text-slate-300"></i></div>
                                            <span class="font-medium">Tidak ada produk ditemukan.</span>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($products->hasPages())
                    <div class="p-4 border-t border-slate-200 bg-slate-50">{{ $products->links() }}</div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <div id="modalTambah" class="modal opacity-0 pointer-events-none fixed inset-0 z-50 flex items-center justify-center">
        <div class="modal-overlay absolute inset-0 bg-slate-900/50 backdrop-blur-sm"></div>
        <div class="modal-container bg-white w-full max-w-2xl mx-4 rounded-2xl shadow-2xl z-50 overflow-hidden transform scale-95 transition-all duration-300 flex flex-col max-h-[90vh]">
            <div class="flex-none flex justify-between items-center px-6 py-4 border-b border-slate-100 bg-slate-50">
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2"><i class="ph-bold ph-plus-circle text-pink-500"></i> Tambah Produk Baru</h3>
                <button type="button" onclick="toggleModal('modalTambah')" class="text-slate-400 hover:text-red-500 transition rounded-full p-1 hover:bg-red-50"><i class="ph-bold ph-x text-xl"></i></button>
            </div>
            <form action="{{ route('produk.store') }}" method="POST" class="flex flex-col flex-1 min-h-0">
                @csrf
                <div class="flex-1 overflow-y-auto p-6 custom-scrollbar">
                    <div class="space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div><label class="form-label">Kode Produk</label><input type="text" name="code" placeholder="Cth: PND-01" class="form-input" required></div>
                            <div>
                                <label class="form-label">Kategori</label>
                                <div class="relative">
                                    <select name="category_id" class="form-input appearance-none cursor-pointer pr-10" required>
                                        <option value="" disabled selected>Pilih Kategori</option>
                                        @foreach($categories as $cat) <option value="{{ $cat->id_kategori }}">{{ $cat->nama_kategori }}</option> @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-slate-500"><i class="ph-bold ph-caret-down"></i></div>
                                </div>
                            </div>
                        </div>
                        <div><label class="form-label">Nama Produk</label><input type="text" name="name" placeholder="Masukkan nama produk..." class="form-input" required></div>
                        <div><label class="form-label">Keterangan</label><textarea name="keterangan" rows="3" class="form-input resize-none" placeholder="Deskripsi singkat..."></textarea></div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div><label class="form-label">Harga (Rp)</label>
                                <div class="relative"><span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 font-bold text-sm">Rp</span><input type="number" name="price" class="form-input pl-10" placeholder="0" required></div>
                            </div>
                            <div><label class="form-label">Stok Awal</label><input type="number" name="stock" class="form-input" placeholder="0" required></div>
                        </div>
                    </div>
                </div>
                <div class="flex-none px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
                    <button type="button" onclick="toggleModal('modalTambah')" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-600 font-medium hover:bg-slate-100 transition text-sm">Batal</button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-pink-500 text-white font-medium hover:bg-pink-600 shadow-lg shadow-pink-500/30 transition flex items-center gap-2 text-sm"><i class="ph-bold ph-plus"></i> Simpan Produk</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(modalID) {
            const modal = document.getElementById(modalID);
            const body = document.querySelector('body');
            const container = modal.querySelector('.modal-container');
            if (modal.classList.contains('opacity-0')) {
                modal.classList.remove('opacity-0', 'pointer-events-none');
                body.classList.add('modal-active');
                setTimeout(() => {
                    container.classList.remove('scale-95');
                    container.classList.add('scale-100');
                }, 10);
            } else {
                container.classList.remove('scale-100');
                container.classList.add('scale-95');
                setTimeout(() => {
                    modal.classList.add('opacity-0', 'pointer-events-none');
                    body.classList.remove('modal-active');
                }, 300);
            }
        }
        document.querySelectorAll('.modal-overlay').forEach(function(overlay) {
            overlay.addEventListener('click', function() {
                toggleModal(overlay.closest('.modal').id);
            });
        });
    </script>
</body>
</html>