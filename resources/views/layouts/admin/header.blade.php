<!-- Navbar Start -->
<nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">

    <!-- Sidebar Toggle -->
    <a href="#" class="sidebar-toggler flex-shrink-0 me-3">
        <i class="fa fa-bars"></i>
    </a>
    <!-- Logo di Header -->
    <a href="{{ route('dashboard') }}" class="navbar-brand d-flex align-items-center">
        <img src="{{ asset('asset-admin/img/logo vertikal.png') }}" class="rounded-circle me-2"
            style="width: auto; height: 40px; object-fit: cover;">
        <span class="fw-bold">Pembangunan Desa</span>
    </a>

    <!-- Search -->
    <form class="d-none d-md-flex ms-4">
        <input class="form-control bg-dark border-0" type="search" placeholder="Search">
    </form>

    <!-- User Menu -->
    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown">

            @if (Auth::check())
                @php
                    $fotoUser = Auth::user()->profile_picture
                        ? asset('storage/profile/' . Auth::user()->profile_picture)
                        : asset('profile/admin.jpg');
                @endphp

                <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">

                    {{-- FOTO --}}
                    <img src="{{ $fotoUser }}" class="rounded-circle me-2"
                        style="width:40px;height:40px;object-fit:cover;">

                    {{-- NAMA & WAKTU --}}
                    <div class="d-none d-lg-block lh-sm">
                        <div class="fw-semibold text-white">
                            {{ Auth::user()->name }}
                        </div>
                        <small class="text-muted">
                         {{ session('last_login') }}
                        </small>
                    </div>
                </a>

                {{-- DROPDOWN --}}
                <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-bottom m-0">
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fa fa-sign-out-alt me-2"></i> Log Out
                        </button>
                    </form>
                </div>
            @else
                <a class="btn btn-success" href="{{ route('login') }}">
                    Login
                </a>
            @endif

        </div>
    </div>

</nav>
<!-- Navbar End -->
