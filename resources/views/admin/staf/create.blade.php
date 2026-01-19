<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Staf - Panda Lovely</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-8">
    <div class="max-w-md mx-auto bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-xl font-bold mb-4">Tambah Staf Baru</h2>
        
        <form action="{{ route('staf.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm text-gray-600">Nama</label>
                <input type="text" name="name" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm text-gray-600">Email</label>
                <input type="email" name="email" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm text-gray-600">Password</label>
                <input type="password" name="password" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm text-gray-600">Role</label>
                <select name="role" class="w-full border p-2 rounded">
                    <option value="admin">Admin</option>
                    <option value="kasir">Kasir</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded">Simpan</button>
                <a href="{{ route('staf.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>