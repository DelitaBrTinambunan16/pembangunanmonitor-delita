@extends('Layouts.Admin.app')

@section('content')

    <!-- Row: Statistik -->
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-4">
            <div class="bg-secondary rounded p-4 d-flex justify-content-between align-items-center">
                <i class="fa fa-project-diagram fa-3x text-danger"></i>
                <div class="text-end">
                    <p class="mb-0 text-light">Proyek</p>
                    <h3 class="text-danger fw-bold">{{ $totalProyek }}</h3>
                    <small class="text-muted">Data aktif</small>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="bg-secondary rounded p-4 d-flex justify-content-between align-items-center">
                <i class="fa fa-users fa-3x text-danger"></i>
                <div class="text-end">
                    <p class="mb-0 text-light">User</p>
                    <h3 class="text-danger fw-bold">{{ $totalUser }}</h3>
                    <small class="text-muted">Terdaftar</small>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="bg-secondary rounded p-4 d-flex justify-content-between align-items-center">
                <i class="fa fa-user-friends fa-3x text-danger"></i>
                <div class="text-end">
                    <p class="mb-0 text-light">Warga</p>
                    <h3 class="text-danger fw-bold">{{ $totalWarga }}</h3>
                    <small class="text-muted">Data warga tersimpan</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Row: Tabel -->
    <div class="bg-secondary rounded p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="text-white mb-0">Daftar Proyek Terbaru</h5>
            <a href="{{ route('proyek.index') }}" class="btn btn-danger btn-sm">
                <i class="fa fa-eye me-1"></i> Lihat Semua
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-dark table-striped align-middle mb-0">
                <thead>
                    <tr class="text-danger">
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Proyek</th>
                        <th>Tahun</th>
                        <th>Lokasi</th>
                        <th>Anggaran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($proyekAktif as $index => $proyek)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $proyek->kode_proyek }}</td>
                            <td>{{ $proyek->nama_proyek }}</td>
                            <td>{{ $proyek->tahun }}</td>
                            <td>{{ $proyek->lokasi }}</td>
                            <td>Rp {{ number_format($proyek->anggaran, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data proyek</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
