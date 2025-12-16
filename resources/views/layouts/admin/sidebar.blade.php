<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark flex-column">

        <!-- MENU -->
        <div class="navbar-nav w-100">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" class="nav-item nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                <i class="fa fa-home me-2"></i>Dashboard
            </a>

            <!-- FITUR UTAMA -->
            <div class="px-3 text-uppercase text-light small mt-3">Fitur Utama</div>

            <a class="nav-link d-flex justify-content-between" data-bs-toggle="collapse" href="#menuFitur">
                <span><i class="fa fa-bars me-2"></i>Fitur Utama</span>
                <i class="fa fa-chevron-down"></i>
            </a>

            <div class="collapse" id="menuFitur">
                <a href="{{ route('proyek.index') }}" class="nav-item nav-link ps-5">
                    <i class="fa fa-table me-2"></i>Proyek
                </a>

                <a href="{{ route('tahapan.index') }}" class="nav-item nav-link ps-5">
                    <i class="fa fa-list me-2"></i>Tahapan
                </a>

                <a href="{{ route('kontraktor.index') }}" class="nav-item nav-link ps-5">
                    <i class="fa fa-hard-hat me-2"></i>Kontraktor
                </a>

                <a href="{{ route('lokasi.index') }}" class="nav-item nav-link ps-5">
                    <i class="fa fa-map-marker-alt me-2"></i>Lokasi Proyek
                </a>

                <a href="{{ route('progres_proyek.index') }}" class="nav-item nav-link ps-5">
                    <i class="fa fa-tasks me-2"></i>Progres
                </a>
            </div>

            <!-- MASTER DATA -->
            <div class="px-3 text-uppercase text-light small mt-3">Master Data</div>

            <a class="nav-link d-flex justify-content-between" data-bs-toggle="collapse" href="#menuMaster">
                <span><i class="fa fa-database me-2"></i>Master Data</span>
                <i class="fa fa-chevron-down"></i>
            </a>

            <div class="collapse" id="menuMaster">
                <a href="{{ route('warga.index') }}" class="nav-item nav-link ps-5">
                    <i class="fa fa-user me-2"></i>Warga
                </a>

                <a href="{{ route('user.index') }}" class="nav-item nav-link ps-5">
                    <i class="fa fa-users me-2"></i>User
                </a>
            </div>
            <li class="nav-item">
                <a href="{{ route('identitas') }}" class="nav-link">
                    <i class="fa fa-user-circle me-2"></i>
                    <span>Identitas</span>
                </a>
            </li>

        </div>
    </nav>
</div>
<!-- Sidebar End -->
