<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panda Lovely - Point of Sale</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Poppins', sans-serif; }
        .animate-float { animation: float 3s ease-in-out infinite; }
        @keyframes float { 0% { transform: translateY(0px); } 50% { transform: translateY(-10px); } 100% { transform: translateY(0px); } }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col justify-center items-center relative overflow-hidden">

    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>

    <div class="relative z-10 w-full max-w-md px-6">
        
        <div class="text-center mb-8 animate-float">
            <div class="inline-flex items-center justify-center w-24 h-24 rounded-3xl bg-white shadow-xl text-pink-600 text-5xl mb-6 transform rotate-3 hover:rotate-0 transition duration-300">
                <i class="fas fa-cash-register"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Panda Lovely</h1>
            <p class="text-gray-500 mt-2 text-sm">Sistem Manajemen Kasir & Stok</p>
        </div>

        <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-2xl p-8 border border-white/50">
            @if (Route::has('login'))
                <div class="flex flex-col gap-4">
                    @auth
                        <div class="text-center mb-2">
                            <p class="text-sm text-gray-500">Halo, <span class="font-bold text-gray-800">{{ Auth::user()->name }}</span>!</p>
                            <p class="text-xs text-gray-400">Anda sudah masuk.</p>
                        </div>

                        <a href="{{ url('/dashboard') }}" 
                           class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 shadow-lg transition-all hover:-translate-y-0.5">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <i class="fas fa-tachometer-alt text-pink-500 group-hover:text-pink-400 transition-colors"></i>
                            </span>
                            Ke Dashboard
                        </a>

                        <a href="{{ route('transaksi.index') }}" 
                           class="group w-full flex justify-center py-3 px-4 border-2 border-pink-100 text-sm font-bold rounded-xl text-pink-600 bg-white hover:bg-pink-50 hover:border-pink-200 transition-all">
                           <i class="fas fa-calculator mr-2 mt-0.5"></i> Buka Mesin Kasir
                        </a>

                    @else
                        <div class="text-center mb-4">
                            <p class="text-sm text-gray-600">Silakan login untuk memulai transaksi.</p>
                        </div>

                        <a href="{{ route('login') }}" 
                           class="group relative w-full flex justify-center py-3.5 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 shadow-lg transition-all hover:-translate-y-0.5">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <i class="fas fa-sign-in-alt text-pink-400 group-hover:text-pink-300"></i>
                            </span>
                            Masuk (Login)
                        </a>

                        @if (Route::has('register'))
                            <div class="relative flex py-2 items-center">
                                <div class="flex-grow border-t border-gray-200"></div>
                                <span class="flex-shrink-0 mx-4 text-gray-400 text-xs">ATAU</span>
                                <div class="flex-grow border-t border-gray-200"></div>
                            </div>

                            <a href="{{ route('register') }}" 
                               class="w-full flex justify-center py-3 px-4 border border-gray-200 text-sm font-semibold rounded-xl text-gray-600 bg-white hover:bg-gray-50 hover:text-pink-600 transition-colors">
                                Daftar Akun Baru
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

        <div class="mt-8 text-center">
            <p class="text-xs text-gray-400">&copy; {{ date('Y') }} Panda Lovely POS System.</p>
        </div>
    </div>

</body>
</html>