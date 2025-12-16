@extends('layouts.admin.app')

@section('content')

{{-- ================= STATISTIK ATAS ================= --}}
<div class="row g-4 mb-4">

    <div class="col-md-4 col-sm-12">
        <div class="bg-secondary rounded p-4 d-flex align-items-center shadow-sm">
            <i class="fa fa-project-diagram fa-3x text-danger me-3"></i>
            <div>
                <div class="text-light">Total Proyek</div>
                <h3 class="text-danger fw-bold mb-0">{{ $totalProyek }}</h3>
                <small class="text-muted">Data proyek terdaftar</small>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="bg-secondary rounded p-4 d-flex align-items-center shadow-sm">
            <i class="fa fa-users fa-3x text-danger me-3"></i>
            <div>
                <div class="text-light">Total Pengguna</div>
                <h3 class="text-danger fw-bold mb-0">{{ $totalUser }}</h3>
                <small class="text-muted">Akun sistem aktif</small>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="bg-secondary rounded p-4 d-flex align-items-center shadow-sm">
            <i class="fa fa-user-friends fa-3x text-danger me-3"></i>
            <div>
                <div class="text-light">Total Warga</div>
                <h3 class="text-danger fw-bold mb-0">{{ $totalWarga }}</h3>
                <small class="text-muted">Data warga tercatat</small>
            </div>
        </div>
    </div>

</div>

{{-- ================= PANEL UTAMA ================= --}}
<div class="row g-4">

    {{-- KIRI : TABEL PROYEK --}}
    <div class="col-lg-7 col-md-12">
        <div class="bg-secondary rounded p-4 shadow-sm h-100">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-white mb-0">Proyek Terbaru</h5>
                <a href="{{ route('proyek.index') }}" class="btn btn-danger btn-sm">
                    <i class="fa fa-eye me-1"></i> Lihat Semua
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-dark table-striped align-middle mb-0">
                    <thead class="text-danger text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Proyek</th>
                            <th>Tahun</th>
                            <th>Lokasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($proyekAktif as $i => $p)
                            <tr>
                                <td class="text-center">{{ $i+1 }}</td>
                                <td>{{ $p->nama_proyek }}</td>
                                <td class="text-center">{{ $p->tahun }}</td>
                                <td>{{ $p->lokasi }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    Belum ada data proyek
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    {{-- KANAN : SLIDESHOW --}}
    <div class="col-lg-5 col-md-12">
        <div class="bg-secondary rounded shadow-sm h-100">

            <div class="p-3 border-bottom border-dark">
                <h6 class="text-white mb-0">
                    <i class="fa fa-image me-2"></i>
                    Dokumentasi Kegiatan Desa
                </h6>
            </div>

            <div id="slideshowPanel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">

                    @for($i = 1; $i <= 15; $i++)
                        <div class="carousel-item {{ $i == 1 ? 'active' : '' }}">
                            <img src="{{ asset('asset-admin/img/slideshow/desa-'.$i.'.jpg') }}"
                                 class="d-block w-100"
                                 style="height:300px; object-fit:cover;"
                                 alt="Dokumentasi Desa">
                        </div>
                    @endfor

                </div>

                <button class="carousel-control-prev" type="button"
                        data-bs-target="#slideshowPanel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>

                <button class="carousel-control-next" type="button"
                        data-bs-target="#slideshowPanel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>

            </div>

        </div>
    </div>

</div>

{{-- ================= STATISTIK & DIAGRAM BAWAH ================= --}}
<div class="row g-4 mt-4">

    <div class="col-lg-7 col-md-12">
        <div class="bg-secondary rounded p-4 shadow-sm">
            <h6 class="text-white mb-3">Jumlah Proyek per Tahun</h6>

            {{-- pembatas tinggi chart --}}
            <div class="w-100" style="height:220px;">
                <canvas id="chartProyekTahun"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-5 col-md-12">
        <div class="bg-secondary rounded p-4 shadow-sm">
            <h6 class="text-white mb-3">Distribusi Sumber Dana</h6>

            {{-- pembatas tinggi chart --}}
            <div class="w-100" style="height:220px;">
                <canvas id="chartSumberDana"></canvas>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('chartProyekTahun'), {
    type: 'bar',
    data: {
        labels: @json($proyekPerTahun->keys()),
        datasets: [{
            label: 'Jumlah Proyek',
            data: @json($proyekPerTahun->values()),

        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { precision: 0 }
            }
        }
    }
});

new Chart(document.getElementById('chartSumberDana'), {
    type: 'pie',
    data: {
        labels: @json($sumberDana->keys()),
        datasets: [{
            data: @json($sumberDana->values()),

        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>


@endsection
