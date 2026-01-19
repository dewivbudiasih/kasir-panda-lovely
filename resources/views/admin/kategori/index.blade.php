<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori - Panda Lovely</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F8F9FA;
        }

        .bg-sidebar {
            background-color: #f8deed;
        }

        .bg-panda {
            background-color: #fac4df;
        }

        .bg-panda:hover {
            background-color: #DB2777;
        }

        .nav-item.active {
            background-color: #fdcff3;
            color: #EC4899;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            font-weight: 600;
            border-radius: 12px;
        }

        .nav-item {
            color: #64748B;
            transition: all 0.2s;
        }

        .nav-item:hover:not(.active) {
            color: #EC4899;
            background-color: rgba(236, 72, 153, 0.1);
            border-radius: 12px;
        }

        .modal {
            transition: opacity 0.3s ease-in-out;
        }

        body.modal-active {
            overflow: hidden !important;
        }

        .form-input {
            width: 100%;
            background-color: #F9FAFB;
            border: 1px solid #E5E7EB;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            outline: none;
            transition: all 0.2s;
        }

        .form-input:focus {
            border-color: #EC4899;
            box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.1);
            background-color: #FFF;
        }

        .form-label {
            display: block;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #6B7280;
            margin-bottom: 0.4rem;
        }
        #sidebar {
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>

<body class="text-slate-800 antialiased">

    <div class="flex h-screen overflow-hidden bg-white">

        <div id="mobile-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-gray-900/50 z-20 hidden md:hidden glass"></div>

        <aside id="sidebar" class="fixed inset-y-0 left-0 z-30 w-64 bg-sidebar flex flex-col justify-between py-6 px-4 h-full border-r border-pink-100 transform -translate-x-full md:translate-x-0 md:relative transition-transform duration-300">
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

                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} flex items-center gap-3 px-4 py-3">
                        <i class="ph-fill ph-squares-four text-xl"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('kategori.index') }}" class="nav-item {{ request()->routeIs('kategori.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3">
                        <i class="ph-fill ph-tag text-xl"></i>
                        <span>Kategori</span>
                    </a>
                </nav>
            </div>
            <div>
                <form action="#" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-white border border-pink-200 text-pink-500 rounded-xl hover:bg-pink-50 transition font-medium">
                        <i class="ph-bold ph-sign-out text-lg"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col h-screen overflow-y-auto bg-gray-50 relative">
            <div class="p-4 md:p-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                    <div class="flex items-center gap-4">
                        <button onclick="toggleSidebar()" class="md:hidden p-2 bg-white rounded-lg shadow-sm text-pink-600 border border-pink-100">
                            <i class="ph-bold ph-list text-2xl"></i>
                        </button>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Manajemen Kategori</h2>
                            <p class="text-gray-500 text-sm mt-1 hidden md:block">Kelola kategori produk Anda di sini.</p>
                        </div>
                    </div>
                    <div class="bg-white border border-gray-100 px-4 py-2 rounded-full text-sm font-medium text-gray-600 shadow-sm flex items-center gap-2">
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
                    <form action="{{ route('kategori.index') }}" method="GET" class="relative w-full md:w-96 group">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori..."
                            class="w-full pl-5 pr-12 py-3 rounded-xl border-0 bg-white shadow-sm ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pink-500 sm:text-sm sm:leading-6">
                        <button type="submit" class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-400 hover:text-pink-600 transition cursor-pointer">
                            <i class="ph-bold ph-magnifying-glass text-lg"></i>
                        </button>
                    </form>

                    <button onclick="toggleModal('modalTambah')" class="w-full md:w-auto bg-panda text-white px-6 py-3 rounded-xl font-medium shadow-md hover:shadow-lg hover:bg-pink-600 transition flex items-center justify-center gap-2">
                        <i class="ph-bold ph-plus"></i> Tambah Kategori
                    </button>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-xs text-gray-500 font-bold uppercase tracking-wider bg-gray-50 border-b border-gray-100">
                                    <th class="py-4 px-6 w-20">ID</th>
                                    <th class="py-4 px-6">Nama Kategori</th>
                                    <th class="py-4 px-6 text-center w-40">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-600 divide-y divide-gray-100">
                                @forelse($categories as $item)
                                <tr class="hover:bg-pink-50/30 transition group">
                                    <td class="py-4 px-6 font-mono text-xs font-semibold text-gray-500 bg-gray-50/50">
                                        {{ $item->id_kategori }}
                                    </td>
                                    <td class="py-4 px-6 font-bold text-gray-800 text-base">
                                        {{ $item->nama_kategori }}
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="flex justify-center gap-2">
                                            <button onclick="toggleModal('modalEdit{{ $item->id_kategori }}')" class="w-8 h-8 flex items-center justify-center text-yellow-500 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition" title="Edit">
                                                <i class="ph-fill ph-pencil-simple"></i>
                                            </button>

                                            <form action="{{ route('kategori.destroy', $item->id_kategori) }}" method="POST" onsubmit="return confirm('Yakin hapus kategori ini? Produk di dalamnya mungkin akan terpengaruh.')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="w-8 h-8 flex items-center justify-center text-red-500 bg-red-50 rounded-lg hover:bg-red-100 transition" title="Hapus">
                                                    <i class="ph-fill ph-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <div id="modalEdit{{ $item->id_kategori }}" class="modal opacity-0 pointer-events-none fixed inset-0 z-50 flex items-center justify-center">
                                    <div class="modal-overlay absolute inset-0 bg-gray-900/75 backdrop-blur-sm"></div>
                                    <div class="modal-container bg-white w-full max-w-md mx-4 rounded-2xl shadow-2xl z-50 overflow-hidden transform scale-95 transition-all duration-300 flex flex-col">
                                        <div class="flex-none flex justify-between items-center px-6 py-4 border-b border-gray-100 bg-gray-50">
                                            <h3 class="text-lg font-bold text-gray-800">Edit Kategori</h3>
                                            <button type="button" onclick="toggleModal('modalEdit{{ $item->id_kategori }}')" class="text-gray-400 hover:text-red-500 transition rounded-full p-1 hover:bg-red-50"><i class="ph-bold ph-x text-xl"></i></button>
                                        </div>
                                        <form action="{{ route('kategori.update', $item->id_kategori) }}" method="POST">
                                            @csrf @method('PUT')
                                            <div class="p-6">
                                                <div>
                                                    <label class="form-label">Nama Kategori</label>
                                                    <input type="text" name="nama_kategori" value="{{ $item->nama_kategori }}" class="form-input font-medium text-gray-800" required>
                                                </div>
                                            </div>
                                            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                                                <button type="button" onclick="toggleModal('modalEdit{{ $item->id_kategori }}')" class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-600 font-medium hover:bg-gray-100 transition text-sm">Batal</button>
                                                <button type="submit" class="px-5 py-2.5 rounded-xl bg-pink-500 text-white font-medium hover:bg-pink-600 shadow-lg shadow-pink-500/30 transition flex items-center gap-2 text-sm"><i class="ph-bold ph-floppy-disk"></i> Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="3" class="py-12 text-center text-gray-400">
                                        <div class="flex flex-col items-center gap-3">
                                            <div class="bg-gray-50 p-4 rounded-full"><i class="ph-duotone ph-tag text-4xl text-gray-300"></i></div>
                                            <span class="font-medium">Belum ada kategori.</span>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($categories->hasPages())
                    <div class="p-4 border-t border-gray-100 bg-gray-50">{{ $categories->links() }}</div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <div id="modalTambah" class="modal opacity-0 pointer-events-none fixed inset-0 z-50 flex items-center justify-center">
        <div class="modal-overlay absolute inset-0 bg-gray-900/75 backdrop-blur-sm"></div>
        <div class="modal-container bg-white w-full max-w-md mx-4 rounded-2xl shadow-2xl z-50 overflow-hidden transform scale-95 transition-all duration-300 flex flex-col">
            <div class="flex-none flex justify-between items-center px-6 py-4 border-b border-gray-100 bg-pink-50/50">
                <h3 class="text-lg font-bold text-pink-600 flex items-center gap-2"><i class="ph-bold ph-plus-circle"></i> Tambah Kategori</h3>
                <button type="button" onclick="toggleModal('modalTambah')" class="text-gray-400 hover:text-red-500 transition rounded-full p-1 hover:bg-red-50"><i class="ph-bold ph-x text-xl"></i></button>
            </div>
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                <div class="p-6">
                    <div>
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" name="nama_kategori" placeholder="Cth: Skincare, Bodycare..." class="form-input" required>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                    <button type="button" onclick="toggleModal('modalTambah')" class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-600 font-medium hover:bg-gray-100 transition text-sm">Batal</button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-pink-500 text-white font-medium hover:bg-pink-600 shadow-lg shadow-pink-500/30 transition flex items-center gap-2 text-sm"><i class="ph-bold ph-plus"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('mobile-overlay');

            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        function toggleModal(modalID) {
            const modal = document.getElementById(modalID);
            const container = modal.querySelector('.modal-container');
            const body = document.body;

            const isClosed = modal.classList.contains('opacity-0');

            if (isClosed) {
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

        document.querySelectorAll('.modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', function() {
                toggleModal(this.closest('.modal').id);
            });
        });
    </script>
</body>

</html>