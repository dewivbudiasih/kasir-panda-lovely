<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panda Lovely Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #fff0f5; /* Pink Pudar */
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        .nav-link {
            color: #333;
            font-weight: 500;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 5px;
        }
        .nav-link:hover {
            background-color: #ffe4e1; /* Pink Hover */
            color: #d63384;
        }
        .nav-link.active {
            background-color: #ff69b4 !important; /* Pink Menyala */
            color: white !important;
        }
        .main-content {
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        {{-- SIDEBAR --}}
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse px-3 pt-3">
            <div class="text-center mb-4">
                <h4 class="fw-bold text-danger">🐾 PANDA LOVELY</h4>
                <small class="text-muted">Administrator</small>
            </div>
            
            <ul class="nav flex-column">
                {{-- 1. DASHBOARD --}}
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}" 
                       href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-grid-fill me-2"></i> Dashboard
                    </a>
                </li>

                {{-- 2. PRODUK --}}
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('produk*') ? 'active' : '' }}" 
                       href="{{ route('produk.index') }}">
                        <i class="bi bi-box-seam-fill me-2"></i> Produk
                    </a>
                </li>

                {{-- 3. KATEGORI --}}
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('kategori*') ? 'active' : '' }}" 
                       href="{{ route('kategori.index') }}">
                        <i class="bi bi-tags-fill me-2"></i> Kategori
                    </a>
                </li>

                {{-- 4. STAF --}}
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('staf*') ? 'active' : '' }}" 
                       href="{{ route('staf.index') }}">
                        <i class="bi bi-people-fill me-2"></i> Staf / User
                    </a>
                </li>

                <hr>

                {{-- 5. LOGOUT --}}
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link w-100 text-start border-0 bg-transparent text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

        {{-- MAIN CONTENT --}}
        <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
            <nav class="navbar navbar-light bg-light d-md-none mb-3 rounded border">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <span class="navbar-brand mb-0 h1 text-danger">Panda Lovely</span>
                </div>
            </nav>

            @yield('content')
            
        </main>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>