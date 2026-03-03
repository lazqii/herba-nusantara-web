<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; min-height: 100vh;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4 fw-bold">Manajemen Tanaman</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        
        {{-- 1. MENU UMUM --}}
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link text-white {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </a>
        </li>

        {{-- 2. MENU KHUSUS ADMIN --}}
        @if(auth()->user()->level == 'admin')
            
            <li class="nav-item mt-3 mb-1">
                <span class="text-white-50 small text-uppercase fw-bold ps-3" style="font-size: 0.75rem;">Master Data</span>
            </li>

            <li>
                <a href="{{ route('tanaman.index') }}" class="nav-link text-white {{ request()->is('tanaman*') ? 'active' : '' }}">
                    <i class="bi bi-flower1 me-2"></i>
                    Data Tanaman
                </a>
            </li>

        @endif

    </ul>
    <hr>
    
    {{-- 3. USER PROFILE & LOGOUT --}}
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            {{-- Avatar Otomatis sesuai Nama User --}}
            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong>{{ Auth::user()->name }}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="#">Level: {{ ucfirst(Auth::user()->level) }}</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                {{-- Form Logout (Wajib pakai form agar aman) --}}
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">Sign out</button>
                </form>
            </li>
        </ul>
    </div>
</div>