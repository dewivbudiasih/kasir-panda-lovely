<div class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard*') ? 'active' : '' }}"
                   href="{{ route('dashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.guru*') ? 'active' : '' }}"
                   href="{{ route('admin.guru.index') }}">
                    <i class="bi bi-person-badge"></i>
                    Guru
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.siswa*') ? 'active' : '' }}"
                   href="{{ route('admin.siswa.index') }}">
                    <i class="bi bi-people"></i>
                    Siswa
                </a>
            </li>

        </ul>
    </div>
</div>
