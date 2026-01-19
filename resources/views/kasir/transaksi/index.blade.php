<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Mesin Kasir - Panda Lovely</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
        .animate-fade-in { animation: fadeIn 0.3s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-5px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>

<body class="bg-gray-100 h-screen overflow-hidden flex text-gray-800">

    <div class="w-full md:w-2/3 flex flex-col h-full relative z-10">
        <div class="bg-white p-4 shadow-sm flex justify-between items-center flex-shrink-0">
            <div>
                <a href="{{ route('kasir.dashboard') }}" class="flex items-center gap-2 text-gray-500 hover:text-pink-600 transition">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <h3 class="font-bold text-gray-800">{{ Auth::user()->name }}</h3>
                    <p class="text-xs text-gray-500">Kasir Aktif</p>
                </div>
                <div class="h-10 w-10 bg-pink-100 rounded-full flex items-center justify-center text-pink-600 font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </div>

        <div class="p-4 bg-gray-50 border-b flex-shrink-0">
            <form action="{{ route('transaksi.index') }}" method="GET">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang (Nama/Kode)..."
                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-pink-300 outline-none transition shadow-sm" autofocus autocomplete="off">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </form>
        </div>

        <div class="flex-1 overflow-y-auto p-4 bg-gray-100 no-scrollbar min-h-0">
            
            @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-4 flex items-center gap-2 border border-green-200">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded-xl mb-4 flex items-center gap-2 border border-red-200">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
            @endif

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 pb-20">
                @forelse($products as $item)
                <div onclick="addToCart(this)" 
                     data-id="{{ $item->id }}"
                     data-name="{{ $item->name }}"
                     data-price="{{ $item->price }}"
                     data-stock="{{ $item->stock }}"
                     class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md cursor-pointer transition transform hover:-translate-y-1 border border-transparent hover:border-pink-300 group flex flex-col justify-between relative min-h-[130px]">
                    
                    @if($item->stock <= 0)
                    <div class="absolute inset-0 bg-white/60 z-10 flex items-center justify-center rounded-xl cursor-not-allowed" onclick="event.stopPropagation()">
                        <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">Stok Habis</span>
                    </div>
                    @endif

                    <div>
                        <h4 class="font-bold text-gray-800 text-sm line-clamp-2 leading-tight mb-1">{{ $item->name }}</h4>
                        <p class="text-[10px] text-gray-400 mb-2 font-mono">
                            {{ $item->code ?? '' }}
                        </p>
                    </div>

                    <div class="flex justify-between items-end mt-auto">
                        <div>
                            <p class="text-[10px] text-gray-500">Stok: {{ $item->stock }}</p>
                            <span class="text-pink-600 font-bold text-base">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                        </div>
                        <div class="h-8 w-8 rounded-full bg-pink-50 group-hover:bg-pink-500 transition flex items-center justify-center text-pink-500 group-hover:text-white text-xs shadow-sm flex-shrink-0">
                            <i class="fas fa-plus"></i>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full flex flex-col items-center justify-center py-20 text-gray-400">
                    <i class="fas fa-search text-4xl mb-4 text-gray-300"></i>
                    <p class="font-medium">Barang tidak ditemukan.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="w-full md:w-1/3 bg-white shadow-2xl flex flex-col h-full border-l border-gray-200 z-20 relative">

        <div class="p-5 bg-gray-50 border-b border-gray-200 flex justify-between items-center flex-shrink-0 z-20">
            <h2 class="text-xl font-bold text-gray-800"><i class="fas fa-shopping-cart text-pink-500 mr-2"></i> Keranjang</h2>
            <button onclick="clearCart()" class="text-xs text-red-500 hover:text-red-700 font-medium hover:underline">Reset</button>
        </div>

        <div id="cart-list" class="flex-1 overflow-y-auto p-4 space-y-3 bg-white custom-scrollbar min-h-0 relative">
            </div>

        <div class="p-5 bg-gray-50 border-t border-gray-200 shadow-[0_-5px_20px_rgba(0,0,0,0.05)] flex-shrink-0 z-30 relative">
            <div class="flex justify-between items-center mb-2 text-sm">
                <span class="text-gray-500">Total Item</span>
                <span id="total-qty" class="font-bold text-gray-800">0</span>
            </div>
            <div class="flex justify-between items-center mb-4">
                <span class="text-lg font-bold text-gray-800">Total Bayar</span>
                <span id="total-price-display" class="text-2xl font-bold text-pink-600">Rp 0</span>
            </div>

            <form action="{{ route('transaksi.store') }}" method="POST" id="checkout-form" onsubmit="return validateCheckout()">
                @csrf
                <input type="hidden" name="cart_data" id="cart-data-input">
                <input type="hidden" name="total_bayar" id="total-bayar-input">

                <div class="grid grid-cols-2 gap-3 mb-4">
                    <label class="cursor-pointer">
                        <input type="radio" name="payment_method" value="tunai" class="peer sr-only" checked onchange="togglePayment('tunai')">
                        <div class="rounded-lg border border-gray-300 p-2 text-center peer-checked:border-pink-500 peer-checked:bg-pink-50 peer-checked:text-pink-700 transition">
                            <i class="fas fa-money-bill text-sm mb-1"></i> <span class="text-xs font-bold">Tunai</span>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="payment_method" value="qris" class="peer sr-only" onchange="togglePayment('qris')">
                        <div class="rounded-lg border border-gray-300 p-2 text-center peer-checked:border-pink-500 peer-checked:bg-pink-50 peer-checked:text-pink-700 transition">
                            <i class="fas fa-qrcode text-sm mb-1"></i> <span class="text-xs font-bold">QRIS</span>
                        </div>
                    </label>
                </div>

                <div class="mb-4 relative" id="cash-input-section">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1 ml-1">Uang Diterima</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 font-bold">Rp</span>
                        <input type="number" id="uang-bayar" name="uang_bayar"
                            class="w-full pl-10 pr-4 py-3 rounded-xl bg-white border border-gray-300 font-bold text-lg text-gray-800 focus:ring-2 focus:ring-pink-500 outline-none transition"
                            placeholder="0" autocomplete="off">
                    </div>
                </div>

                <div id="qris-image-section" class="mb-4 hidden text-center animate-fade-in">
                    <div class="bg-white p-3 rounded-xl border border-gray-200 inline-block shadow-sm">
                        <img src="{{ asset('qiuris.jpeg') }}" alt="Scan QRIS" class="w-40 h-40 object-contain mx-auto">
                        <p class="text-[10px] text-gray-500 mt-1">Scan untuk bayar</p>
                    </div>
                </div>

                <div id="kembalian-section" class="flex justify-between items-center mb-4 text-sm bg-white p-3 rounded-lg border border-gray-200">
                    <span class="text-gray-500 font-medium">Kembalian:</span>
                    <span id="kembalian-display" class="font-bold text-gray-800 text-lg">Rp 0</span>
                    <input type="hidden" name="kembalian" id="kembalian-input">
                </div>

                <button type="submit" id="btn-bayar" disabled
                    class="w-full bg-gray-300 text-white font-bold py-4 rounded-xl shadow-lg transition-all flex justify-center items-center gap-2 cursor-not-allowed transform active:scale-95">
                    <i class="fas fa-print"></i> Bayar & Cetak
                </button>
            </form>
        </div>
    </div>

    <script>
        // PERBAIKAN: Menggunakan tag PHP Echo biasa untuk menghindari Syntax Error di Blade
        const rawCartSession = <?php echo json_encode(session('cart', [])); ?>;
        
        // Pastikan format data array
        let cart = Array.isArray(rawCartSession) ? rawCartSession : Object.values(rawCartSession);
        
        let currentPaymentMethod = 'tunai';

        document.addEventListener("DOMContentLoaded", function() {
            updateCartUI();
        });

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        // Logic tambah ke keranjang
        function addToCart(element) {
            // Jika diklik pada overlay stok habis, jangan lakukan apa-apa
            if(element.querySelector('.cursor-not-allowed')) return;

            const id = parseInt(element.getAttribute('data-id'));
            const name = element.getAttribute('data-name');
            const price = parseInt(element.getAttribute('data-price'));
            const stock = parseInt(element.getAttribute('data-stock'));

            if (stock <= 0) {
                alert('Stok barang habis!');
                return;
            }

            let existingItem = cart.find(item => item.id === id);
            
            if (existingItem) {
                if (existingItem.qty < stock) {
                    existingItem.qty++;
                } else {
                    alert('Stok tidak mencukupi! Sisa stok: ' + stock);
                    return;
                }
            } else {
                cart.push({ id: id, name: name, price: price, qty: 1, stock: stock });
            }

            updateCartUI();
            
            // Simpan ke session via AJAX
            syncCart("{{ route('transaksi.addCart') }}", id);
        }

        function increaseQty(id) {
            let item = cart.find(item => item.id === id);
            if (item && item.qty < item.stock) {
                item.qty++;
                updateCartUI();
                syncCart("{{ route('transaksi.addCart') }}", id);
            } else {
                alert('Mencapai batas stok!');
            }
        }

        function decreaseQty(id) {
            let item = cart.find(item => item.id === id);
            if (item) {
                item.qty--;
                if (item.qty <= 0) {
                    cart = cart.filter(i => i.id !== id);
                }
                updateCartUI();
                syncCart("{{ route('transaksi.removeCart') }}", id);
            }
        }

        function syncCart(url, id) {
            fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ id: id })
            }).catch(error => console.error('Error syncing cart:', error));
        }

        function clearCart() {
            if (cart.length > 0 && confirm('Kosongkan keranjang?')) {
                cart = [];
                updateCartUI();
                const inputUang = document.getElementById('uang-bayar');
                if(inputUang) inputUang.value = '';

                fetch("{{ route('transaksi.clearCart') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
            }
        }

        function updateCartUI() {
            const listContainer = document.getElementById('cart-list');
            const scrollTop = listContainer ? listContainer.scrollTop : 0;

            if(!listContainer) return;

            listContainer.innerHTML = '';

            if (cart.length === 0) {
                listContainer.innerHTML = `
                    <div id="empty-cart" class="text-center py-20 text-gray-400 flex flex-col items-center absolute inset-0 justify-center">
                        <i class="fas fa-basket-shopping text-6xl mb-4 text-gray-200"></i>
                        <p class="text-sm">Belum ada barang.</p>
                        <p class="text-xs text-gray-400 mt-1">Pilih produk di sebelah kiri.</p>
                    </div>`;
            } else {
                cart.forEach(item => {
                    let html = `
                    <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-sm flex justify-between items-center mb-2 animate-fade-in relative group hover:border-pink-200 transition">
                        <div class="flex-1">
                            <h5 class="font-bold text-gray-800 text-sm leading-tight mb-1">${item.name}</h5>
                            <p class="text-xs text-pink-500 font-medium">Rp ${formatRupiah(item.price)}</p>
                        </div>
                        <div class="flex items-center gap-3 bg-gray-50 rounded-lg p-1">
                            <button type="button" onclick="decreaseQty(${item.id})" class="h-6 w-6 rounded bg-white text-gray-600 shadow-sm hover:bg-pink-100 hover:text-pink-600 flex items-center justify-center text-xs transition font-bold">-</button>
                            <span class="font-bold text-sm w-5 text-center text-gray-700">${item.qty}</span>
                            <button type="button" onclick="increaseQty(${item.id})" class="h-6 w-6 rounded bg-white text-gray-600 shadow-sm hover:bg-pink-100 hover:text-pink-600 flex items-center justify-center text-xs transition font-bold">+</button>
                        </div>
                    </div>`;
                    listContainer.innerHTML += html;
                });
                listContainer.innerHTML += `<div class="h-2"></div>`;
            }

            listContainer.scrollTop = scrollTop;
            calculateTotal();
        }

        function calculateTotal() {
            let totalQty = 0;
            let totalPrice = 0;

            cart.forEach(item => {
                totalQty += item.qty;
                totalPrice += (item.price * item.qty);
            });

            document.getElementById('total-qty').innerText = totalQty;
            document.getElementById('total-price-display').innerText = 'Rp ' + formatRupiah(totalPrice);
            document.getElementById('cart-data-input').value = JSON.stringify(cart);
            document.getElementById('total-bayar-input').value = totalPrice;

            // Auto fill jika QRIS
            if (currentPaymentMethod === 'qris') {
                document.getElementById('uang-bayar').value = totalPrice;
            }
            checkPayment();
        }

        function togglePayment(method) {
            currentPaymentMethod = method;
            const cashSection = document.getElementById('cash-input-section');
            const qrisSection = document.getElementById('qris-image-section');
            const kembalianSection = document.getElementById('kembalian-section');
            const inputUang = document.getElementById('uang-bayar');
            const total = parseInt(document.getElementById('total-bayar-input').value) || 0;

            if (method === 'qris') {
                cashSection.style.display = 'none';
                qrisSection.style.display = 'block';
                kembalianSection.style.display = 'none';
                inputUang.value = total;
            } else {
                cashSection.style.display = 'block';
                qrisSection.style.display = 'none';
                kembalianSection.style.display = 'flex';
                inputUang.value = '';
                inputUang.focus();
            }
            checkPayment();
        }

        const inputUang = document.getElementById('uang-bayar');
        const btnBayar = document.getElementById('btn-bayar');

        if (inputUang) {
            inputUang.addEventListener('input', checkPayment);
            inputUang.addEventListener('keyup', checkPayment);
        }

        function checkPayment() {
            let total = parseInt(document.getElementById('total-bayar-input').value) || 0;
            let uang = parseInt(document.getElementById('uang-bayar').value) || 0;
            let kembalian = uang - total;

            if (uang > 0 && total > 0) {
                document.getElementById('kembalian-display').innerText = 'Rp ' + formatRupiah(Math.max(0, kembalian));
                document.getElementById('kembalian-input').value = kembalian;
            } else {
                document.getElementById('kembalian-display').innerText = 'Rp 0';
                document.getElementById('kembalian-input').value = 0;
            }

            // Validasi Tombol Bayar
            if (cart.length > 0 && uang >= total && total > 0) {
                btnBayar.disabled = false;
                btnBayar.classList.remove('bg-gray-300', 'cursor-not-allowed');
                btnBayar.classList.add('bg-pink-600', 'hover:bg-pink-700', 'text-white', 'cursor-pointer');
            } else {
                btnBayar.disabled = true;
                btnBayar.classList.add('bg-gray-300', 'cursor-not-allowed');
                btnBayar.classList.remove('bg-pink-600', 'hover:bg-pink-700', 'text-white', 'cursor-pointer');
            }
        }

        function validateCheckout() {
            if (cart.length === 0) {
                alert('Keranjang kosong!');
                return false;
            }
            let total = parseInt(document.getElementById('total-bayar-input').value) || 0;
            let uang = parseInt(document.getElementById('uang-bayar').value) || 0;
            
            if(uang < total) {
                alert('Uang pembayaran kurang!');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>