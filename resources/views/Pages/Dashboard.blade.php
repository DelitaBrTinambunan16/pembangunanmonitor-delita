@extends('Layouts.Admin.app')

@section('content')
<div class="content">
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-light rounded p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0 text-white">Dashboard</h3>
            </div>

            <!-- STATISTIC CARDS -->
            <div class="row g-4 mb-4">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="bg-dark rounded p-4 text-center shadow-sm">
                        <h5 class="text-light">Proyek</h5>
                        <h2 class="text-primary">{{ $totalProyek }}</h2>
                        <small class="text-muted">
                            {{ $totalProyek > 0 ? 'Data aktif' : 'Belum ada data' }}
                        </small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-dark rounded p-4 text-center shadow-sm">
                        <h5 class="text-light">User</h5>
                        <h2 class="text-primary">{{ $totalUser }}</h2>
                        <small class="text-muted">
                            {{ $totalUser > 0 ? 'Terdaftar' : 'Belum ada user' }}
                        </small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-dark rounded p-4 text-center shadow-sm">
                        <h5 class="text-light">Warga</h5>
                        <h2 class="text-primary">{{ $totalWarga }}</h2>
                        <small class="text-muted">
                            {{ $totalWarga > 0 ? 'Data warga tersimpan' : 'Belum ada data' }}
                        </small>
                    </div>
                </div>
            </div>

            <!-- TABLE SECTION -->
            <div class="bg-dark rounded p-4 shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="text-white mb-0">Daftar Proyek Terbaru</h5>
                    <a href="{{ route('proyek.index') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-eye me-1"></i> Lihat Semua
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle mb-0">
                        <thead>
                            <tr class="text-primary">
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Proyek</th>
                                <th>Tahun</th>
                                <th>Lokasi</th>
                                <th>Anggaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($proyekAktif as $index => $p)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $p->kode_proyek }}</td>
                                    <td>{{ $p->nama_proyek }}</td>
                                    <td>{{ $p->tahun }}</td>
                                    <td>{{ $p->lokasi }}</td>
                                    <td>Rp {{ number_format($p->anggaran, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Belum ada proyek</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
