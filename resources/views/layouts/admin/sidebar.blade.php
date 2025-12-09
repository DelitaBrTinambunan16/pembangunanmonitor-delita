<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark flex-column">

        <!-- Logo dan Nama Aplikasi -->
        <div class="text-center py-4 border-bottom border-dark">
            <a href="{{ route('dashboard') }}"
                class="text-decoration-none d-flex align-items-center justify-content-center">
                <img src="{{ asset('asset-admin/img/logo-desa.jpg') }}" alt="Logo Desa" class="rounded-circle me-2"
                    style="width: 55px; height: 55px; object-fit: cover; border: 2px solid #dc3545;">
                <div class="text-start">
                    <h4 class="text-danger fw-bold mb-0">Pembangunan</h4>
                    <small class="text-light">Monitoring Desa</small>
                </div>
            </a>
        </div>

        <!-- Navigasi -->
        <div class="navbar-nav w-100 mt-2">
            <a href="{{ route('dashboard') }}" class="nav-item nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                <i class="fa fa-tachometer-alt me-2"></i>Dashboard
            </a>

            <a href="{{ route('proyek.index') }}"
                class="nav-item nav-link {{ Request::is('proyek*') ? 'active' : '' }}">
                <i class="fa fa-table me-2"></i>Proyek
            </a>

            <a href="{{ route('user.index') }}" class="nav-item nav-link {{ Request::is('user*') ? 'active' : '' }}">
                <i class="fa fa-users me-2"></i>User
            </a>

            <a href="{{ route('warga.index') }}" class="nav-item nav-link {{ Request::is('warga*') ? 'active' : '' }}">
                <i class="fa fa-id-card me-2"></i>Warga
            </a>

            <a href="{{ route('tahapan.index') }}"
                class="nav-item nav-link {{ Request::is('tahapan*') ? 'active' : '' }}">
                <i class="fa fa-id-card me-2"></i>Tahapan Proyek
            </a>

            <!-- Link Baru -->
            <a href="{{ route('kontraktor.index') }}"
                class="nav-item nav-link {{ Request::is('kontraktor*') ? 'active' : '' }}">
                <i class="fa fa-hard-hat me-2"></i>Kontraktor
            </a>

            <a href="{{ route('lokasi.index') }}"
                class="nav-item nav-link {{ Request::is('lokasi*') ? 'active' : '' }}">
                <i class="fa fa-map-marker-alt me-2"></i>Lokasi Proyek
            </a>

            <a href="{{ route('progres_proyek.index') }}"
                class="nav-item nav-link {{ Request::is('progres*') ? 'active' : '' }}">
                <i class="fa fa-tasks me-2"></i>Progres Proyek
            </a>
        </div>
    </nav>
</div>
<!-- Sidebar End -->
