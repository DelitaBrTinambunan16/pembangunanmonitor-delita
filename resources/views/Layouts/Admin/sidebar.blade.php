<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark flex-column">

        <!-- Logo dan Nama Aplikasi -->
        <div class="text-center py-4 border-bottom border-dark">
            <a href="{{ route('dashboard') }}" class="text-decoration-none d-flex align-items-center justify-content-center">
                <img src="{{ asset('asset-admin/img/logo-desa.jpg') }}"
                     alt="Logo Desa"
                     class="rounded-circle me-2"
                     style="width: 55px; height: 55px; object-fit: cover; border: 2px solid #dc3545;">
                <div class="text-start">
                    <h4 class="text-danger fw-bold mb-0">Pembangunan</h4>
                    <small class="text-light">Monitoring Desa</small>
                </div>
            </a>
        </div>
{{-- 
        <!-- Profil Admin -->
        <div class="d-flex flex-column align-items-center text-center mt-4 mb-4">
            <div class="position-relative mb-2">
                <img class="rounded-circle border border-2 border-light"
                     src="{{ asset('asset-admin/img/deli.jpg') }}"
                     alt="Foto Admin"
                     style="width: 60px; height: 60px; object-fit: cover;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div>
                <h6 class="mb-0 text-light fw-semibold">Delita</h6>
                <span class="text-muted small">Admin</span>
            </div>
        </div> --}}

        <!-- Navigasi -->
        <div class="navbar-nav w-100 mt-2">
            <a href="{{ route('dashboard') }}"
               class="nav-item nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                <i class="fa fa-tachometer-alt me-2"></i>Dashboard
            </a>

            <a href="{{ route('proyek.index') }}"
               class="nav-item nav-link {{ Request::is('proyek*') ? 'active' : '' }}">
                <i class="fa fa-table me-2"></i>Proyek
            </a>

            <a href="{{ route('user.index') }}"
               class="nav-item nav-link {{ Request::is('user*') ? 'active' : '' }}">
                <i class="fa fa-users me-2"></i>User
            </a>

            <a href="{{ route('warga.index') }}"
               class="nav-item nav-link {{ Request::is('warga*') ? 'active' : '' }}">
                <i class="fa fa-id-card me-2"></i>Warga
            </a>
        </div>
    </nav>
</div>
<!-- Sidebar End -->
