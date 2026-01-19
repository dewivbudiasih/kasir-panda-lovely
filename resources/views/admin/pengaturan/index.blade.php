<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - Panda Lovely</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #ebc2e2; }
        
        .active-menu {
            background-color: #ffd4ee;
            color: #DB2777;
            font-weight: 600;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body class="text-slate-800">
    <div class="flex h-screen overflow-hidden bg-white">
        
        <aside class="w-64 bg-pink-50 flex flex-col py-6 px-4 hidden md:flex h-full border-r border-pink-100 shadow-lg relative z-20">
            
            <div class="flex items-center gap-3 mb-10 px-2">
                <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shadow-sm overflow-hidden border-2 border-pink-200">
                    <img src="{{ asset('img/panda.jpg') }}" alt="Logo" class="w-full h-full object-cover">
                </div>
                <div class="flex flex-col">
                    <h1 class="text-xl font-bold text-pink-600 leading-none tracking-wide">PANDA</h1>
                    <span class="text-xs font-bold text-pink-400 leading-none tracking-wide">LOVELY</span>
                </div>
            </div>

            <nav class="space-y-2 flex-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-pink-600 hover:bg-pink-100 rounded-xl transition">
                    <i class="ph-bold ph-squares-four text-xl"></i> Dashboard
                </a>
                <a href="{{ route('pengaturan.index') }}" class="active-menu flex items-center gap-3 px-4 py-3 rounded-xl transition">
                    <i class="ph-fill ph-gear text-xl"></i> Pengaturan
                </a>
            </nav>

            <div class="mt-auto pt-6 border-t border-pink-200/50">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 bg-white hover:bg-pink-50 text-pink-600 font-bold py-3 px-4 rounded-xl shadow-sm border border-pink-200 transition-all duration-300 transform hover:scale-[1.02] active:scale-95">
                        <i class="ph-bold ph-sign-out text-lg"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>

        </aside>

        <main class="flex-1 flex flex-col h-screen overflow-y-auto bg-slate-50 p-8">
            
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800">Pengaturan Toko</h2>
                    <p class="text-slate-400 text-sm mt-1">Kelola informasi dasar toko Anda.</p>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-50 text-green-600 p-4 rounded-xl mb-6 border border-green-100 flex items-center gap-2">
                    <i class="ph-fill ph-check-circle text-xl"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm max-w-2xl p-8">
                <form action="{{ route('pengaturan.update') }}" method="POST">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Toko</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="ph-bold ph-storefront"></i>
                                </span>
                                <input type="text" name="nama_toko" value="{{ $setting->nama_toko ?? 'Panda Lovely' }}" class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-200 focus:border-pink-500 outline-none transition">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nomor HP / WhatsApp</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="ph-bold ph-whatsapp-logo"></i>
                                </span>
                                <input type="text" name="no_hp" value="{{ $setting->no_hp }}" class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-200 focus:border-pink-500 outline-none transition">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap</label>
                            <div class="relative">
                                <span class="absolute top-3 left-3 text-gray-400">
                                    <i class="ph-bold ph-map-pin"></i>
                                </span>
                                <textarea name="alamat" rows="4" class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-200 focus:border-pink-500 outline-none transition">{{ $setting->alamat }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="flex items-center gap-2 bg-pink-500 text-white px-8 py-3 rounded-xl hover:bg-pink-600 font-medium shadow-lg hover:shadow-pink-500/30 transition transform hover:-translate-y-1">
                            <i class="ph-bold ph-floppy-disk"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>