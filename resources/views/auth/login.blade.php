<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Panda Lovely POS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gradient-to-br from-pink-100 to-pink-300 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-md rounded-2xl shadow-xl overflow-hidden transform hover:scale-105 transition duration-300 ease-in-out">
        
        <div class="bg-pink-500 p-8 text-center">
            <h1 class="text-3xl font-bold text-white tracking-wider">PANDA LOVELY</h1>
            <p class="text-pink-100 mt-2 text-sm">Sistem Kasir </p>
        </div>

        <div class="p-8">
            <h2 class="text-2xl font-semibold text-gray-700 text-center mb-6">Silakan Masuk</h2>

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded text-sm text-center">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.proses') }}" method="POST">
                @csrf 
                
                <div class="mb-5">
                    <label for="email" class="block text-gray-600 text-sm font-medium mb-2">Alamat Email</label>
                    <input type="email" name="email" id="email" 
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition"
                        placeholder="admin@panda.com" required autofocus>
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-gray-600 text-sm font-medium mb-2">Kata Sandi</label>
                    <input type="password" name="password" id="password" 
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition"
                        placeholder="Masukkan password" required>
                </div>

                <button type="submit" 
                    class="w-full bg-pink-500 hover:bg-pink-600 text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                    MASUK SEKARANG
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-500">© 2026 Panda Lovely System</p>
            </div>
        </div>
    </div>
</body>
</html>