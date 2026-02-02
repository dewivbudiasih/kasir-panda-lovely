<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Panda Lovely POS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-pink-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-sm rounded-xl shadow-lg overflow-hidden p-8">
        
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-pink-500 tracking-wide">PANDA LOVELY</h1>
            <p class="text-gray-400 text-sm mt-1">Sistem Kasir</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.proses') }}" method="POST">
            @csrf 
            
            <div class="mb-4">
                <label for="email" class="block text-gray-500 text-xs font-semibold mb-2 uppercase tracking-wider">Email</label>
                <input type="email" name="email" id="email" 
                    class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 text-gray-700 focus:outline-none focus:bg-white focus:border-pink-400 focus:ring-1 focus:ring-pink-400 transition duration-200"
                    placeholder="admin@panda.com" required autofocus>
            </div>

            <div class="mb-8">
                <label for="password" class="block text-gray-500 text-xs font-semibold mb-2 uppercase tracking-wider">Password</label>
                <input type="password" name="password" id="password" 
                    class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 text-gray-700 focus:outline-none focus:bg-white focus:border-pink-400 focus:ring-1 focus:ring-pink-400 transition duration-200"
                    placeholder="••••••" required>
            </div>

            <button type="submit" 
                class="w-full bg-pink-500 hover:bg-pink-600 text-white font-semibold py-3 px-4 rounded-lg transition duration-200">
                Masuk
            </button>
        </form>

        <div class="mt-8 text-center">
            <p class="text-xs text-gray-400">© 2026 Panda Lovely System</p>
        </div>
    </div>
</body>
</html>