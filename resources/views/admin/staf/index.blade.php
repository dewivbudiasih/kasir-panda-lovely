<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Staf - Panda Lovely</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="flex h-screen">
        
        <aside class="w-64 bg-pink-100 p-6 shadow-lg flex flex-col h-full">
            
            <div class="flex items-center gap-3 mb-10">
                <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shadow-sm p-0.5 border-2 border-pink-200">
                    <img src="{{ asset('img/panda.jpg') }}" alt="Logo" class="w-full h-full object-cover rounded-full">
                </div>
                
                <div class="flex flex-col">
                    <h1 class="text-xl font-bold text-pink-600 leading-none tracking-wide">PANDA</h1>
                    <span class="text-xs font-bold text-pink-400 leading-none tracking-wide">LOVELY</span>
                </div>
            </div>

            <nav class="space-y-2 flex-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-pink-200 rounded-xl transition">
                    <i class="ph ph-squares-four text-xl"></i> Dashboard
                </a>
                <a href="{{ route('staf.index') }}" class="flex items-center gap-3 p-3 bg-white text-pink-600 font-bold rounded-xl shadow-sm transition">
                    <i class="ph-fill ph-users text-xl"></i> Staf / Admin
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

        <main class="flex-1 p-8 overflow-y-auto">
            <header class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Manajemen Staf</h2>
                    <p class="text-gray-500 text-sm">Kelola pengguna yang memiliki akses ke sistem.</p>
                </div>
                <a href="{{ route('staf.create') }}" class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600 transition flex items-center gap-2 shadow-md">
                    <i class="ph-bold ph-plus"></i> Tambah Staf
                </a>
            </header>

            @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-green-700 font-bold">&times;</button>
            </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="p-4 font-semibold">Nama</th>
                            <th class="p-4 font-semibold">Email</th>
                            <th class="p-4 font-semibold">Role</th>
                            <th class="p-4 font-semibold">Bergabung</th>
                            <th class="p-4 font-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        @forelse($users as $user)
                        <tr class="hover:bg-pink-50/50 transition">
                            <td class="p-4 font-medium text-gray-800">{{ $user->name }}</td>
                            <td class="p-4 text-gray-600">{{ $user->email }}</td>
                            <td class="p-4">
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">
                                    {{ $user->role ?? 'Admin' }}
                                </span>
                            </td>
                            <td class="p-4 text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="p-4 text-center flex justify-center gap-2">
                                <a href="{{ route('staf.edit', $user->id) }}" class="text-yellow-500 hover:text-yellow-600 text-lg">
                                    <i class="ph-fill ph-pencil-simple"></i>
                                </a>
                                <form action="{{ route('staf.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-lg">
                                        <i class="ph-fill ph-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-400">Belum ada data staf.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="p-4">
                    @if(method_exists($users, 'links'))
                    {{ $users->links() }}
                    @endif
                </div>
            </div>
        </main>
    </div>
</body>
</html>