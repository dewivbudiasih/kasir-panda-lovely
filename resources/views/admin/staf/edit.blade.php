<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Staf - Panda Lovely</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-pink-50 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl border border-pink-100">
        
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Edit Data Staf</h2>
            <p class="text-sm text-gray-500">Perbarui informasi pengguna di bawah ini.</p>
        </div>
        
        <form action="{{ route('staf.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ $user->name }}" 
                    class="w-full border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition shadow-sm placeholder-gray-400" 
                    placeholder="Masukkan nama staf" required>
            </div>

            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                <input type="email" name="email" value="{{ $user->email }}" 
                    class="w-full border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition shadow-sm placeholder-gray-400" 
                    placeholder="nama@email.com" required>
            </div>

            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Password <span class="text-xs font-normal text-pink-500 ml-1">(Kosongkan jika tidak diganti)</span>
                </label>
                <input type="password" name="password" 
                    class="w-full border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition shadow-sm bg-gray-50 placeholder-gray-400"
                    placeholder="********">
            </div>

            <div class="mb-8">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Role / Jabatan</label>
                <div class="relative">
                    <select name="role" class="w-full border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition shadow-sm appearance-none bg-white">
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="kasir" {{ $user->role == 'kasir' ? 'selected' : '' }}>Kasir</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-3">
                <button type="submit" class="w-full bg-pink-500 hover:bg-pink-600 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-pink-200 transition-all transform hover:scale-[1.02]">
                    Update Data
                </button>
                <a href="{{ route('staf.index') }}" class="w-full bg-white border border-gray-300 hover:bg-gray-50 text-gray-600 font-semibold py-3 px-4 rounded-xl text-center transition">
                    Batal
                </a>
            </div>

        </form>
    </div>

</body>
</html>