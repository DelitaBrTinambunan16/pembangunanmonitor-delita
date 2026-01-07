<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark flex-column">

        <!-- LOGO SIDEBAR -->
        <div class="sidebar-brand d-flex align-items-center gap-2 px-3 py-0">
            <img src="{{ asset('asset-admin/img/logo_vertikal.png') }}" alt="Logo" width="70" height="70"
                class="rounded-circle flex-shrink-0">
            <span class="fw-semibold text-white small lh-sm">
                Sistem<br>Pembangunan
            </span>
        </div>

        <hr class="text-light mx-3 my-1">

        <div class="navbar-nav w-100 mt-1">

            <!-- DASHBOARD -->
            <a href="{{ route('dashboard') }}" class="nav-item nav-link py-2">
                <i class="fa fa-home me-2"></i>Dashboard
            </a>

            <!-- FITUR UTAMA -->
            <div class="px-3 text-uppercase text-light small mt-3">Fitur Utama</div>

            <a class="nav-link d-flex justify-content-between" data-bs-toggle="collapse" href="#menuFitur">
                <span><i class="fa fa-bars me-2"></i>Fitur Utama</span>
                <i class="fa fa-chevron-down"></i>
            </a>

            <div class="collapse show" id="menuFitur">

                {{-- PROYEK --}}
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('proyek.index') }}" class="nav-item nav-link ps-5">
                @elseif(auth()->user()->role === 'staff')
                    <a href="{{ route('staff.proyek.index') }}" class="nav-item nav-link ps-5">
                @else
                    <a href="{{ route('view.proyek.index') }}" class="nav-item nav-link ps-5">
                @endif
                    <i class="fa fa-table me-2"></i>Proyek
                </a>

                {{-- TAHAPAN --}}
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('tahapan.index') }}" class="nav-item nav-link ps-5">
                @elseif(auth()->user()->role === 'staff')
                    <a href="{{ route('staff.tahapan.index') }}" class="nav-item nav-link ps-5">
                @else
                    <a href="{{ route('view.tahapan.index') }}" class="nav-item nav-link ps-5">
                @endif
                    <i class="fa fa-list me-2"></i>Tahapan
                </a>

                {{-- KONTRAKTOR --}}
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('kontraktor.index') }}" class="nav-item nav-link ps-5">
                @elseif(auth()->user()->role === 'staff')
                    <a href="{{ route('staff.kontraktor.index') }}" class="nav-item nav-link ps-5">
                @else
                    <a href="{{ route('view.kontraktor.index') }}" class="nav-item nav-link ps-5">
                @endif
                    <i class="fa fa-hard-hat me-2"></i>Kontraktor
                </a>

                {{-- LOKASI --}}
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('lokasi.index') }}" class="nav-item nav-link ps-5">
                @elseif(auth()->user()->role === 'staff')
                    <a href="{{ route('staff.lokasi.index') }}" class="nav-item nav-link ps-5">
                @else
                    <a href="{{ route('view.lokasi.index') }}" class="nav-item nav-link ps-5">
                @endif
                    <i class="fa fa-map-marker-alt me-2"></i>Lokasi Proyek
                </a>

                {{-- PROGRES --}}
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('progres_proyek.index') }}" class="nav-item nav-link ps-5">
                @elseif(auth()->user()->role === 'staff')
                    <a href="{{ route('staff.progres_proyek.index') }}" class="nav-item nav-link ps-5">
                @else
                    <a href="{{ route('view.progres_proyek.index') }}" class="nav-item nav-link ps-5">
                @endif
                    <i class="fa fa-tasks me-2"></i>Progres
                </a>
            </div>

            <!-- MASTER DATA -->
            <div class="px-3 text-uppercase text-light small mt-3">Master Data</div>

            <a class="nav-link d-flex justify-content-between" data-bs-toggle="collapse" href="#menuMaster">
                <span><i class="fa fa-database me-2"></i>Master Data</span>
                <i class="fa fa-chevron-down"></i>
            </a>

            <div class="collapse show" id="menuMaster">

                {{-- WARGA --}}
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('warga.index') }}" class="nav-item nav-link ps-5">
                @elseif(auth()->user()->role === 'staff')
                    <a href="{{ route('staff.warga.index') }}" class="nav-item nav-link ps-5">
                @else
                    <a href="{{ route('view.warga.index') }}" class="nav-item nav-link ps-5">
                @endif
                    <i class="fa fa-user me-2"></i>Warga
                </a>

                {{-- USER (ADMIN ONLY) --}}
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('user.index') }}" class="nav-item nav-link ps-5">
                        <i class="fa fa-users me-2"></i>User
                    </a>
                @endif
            </div>

            <!-- IDENTITAS -->
            <a href="{{ route('identitas') }}" class="nav-item nav-link mt-2">
                <i class="fa fa-user-circle me-2"></i>Identitas
            </a>

        </div>
    </nav>
</div>
<!-- Sidebar End -->
