@extends('layouts.admin.app')

@section('content')

<!-- Statistik Cards -->
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="bg-secondary rounded p-4 d-flex justify-content-between align-items-center shadow-sm">
            <i class="fa fa-project-diagram fa-3x text-danger"></i>
            <div class="text-end">
                <p class="mb-0 text-light">Total Proyek</p>
                <h3 class="text-danger fw-bold">{{ $totalProyek }}</h3>
                <small class="text-muted">Data proyek tersimpan</small>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-4">
        <div class="bg-secondary rounded p-4 d-flex justify-content-between align-items-center shadow-sm">
            <i class="fa fa-users fa-3x text-danger"></i>
            <div class="text-end">
                <p class="mb-0 text-light">Total User</p>
                <h3 class="text-danger fw-bold">{{ $totalUser }}</h3>
                <small class="text-muted">User terdaftar</small>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-4">
        <div class="bg-secondary rounded p-4 d-flex justify-content-between align-items-center shadow-sm">
            <i class="fa fa-user-friends fa-3x text-danger"></i>
            <div class="text-end">
                <p class="mb-0 text-light">Total Warga</p>
                <h3 class="text-danger fw-bold">{{ $totalWarga }}</h3>
                <small class="text-muted">Data warga tersimpan</small>
            </div>
        </div>
    </div>
</div>

<!-- Daftar Proyek dari Database -->
<div class="bg-secondary rounded p-4 shadow-sm">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-white mb-0">Daftar Proyek Terbaru</h5>
        <a href="{{ route('proyek.index') }}" class="btn btn-danger btn-sm">
            <i class="fa fa-eye me-1"></i> Lihat Semua
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-dark table-striped align-middle mb-0">
            <thead class="text-danger text-center">
                <tr>
                    <th>No</th>
                    <th>Kode Proyek</th>
                    <th>Nama Proyek</th>
                    <th>Tahun</th>
                    <th>Lokasi</th>
                    <th>Anggaran</th>
                    <th>Sumber Dana</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse ($proyekAktif as $index => $proyek)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $proyek->kode_proyek }}</td>
                        <td class="text-start">{{ $proyek->nama_proyek }}</td>
                        <td>{{ $proyek->tahun }}</td>
                        <td>{{ $proyek->lokasi }}</td>
                        <td>Rp {{ number_format($proyek->anggaran, 0, ',', '.') }}</td>
                        <td>{{ $proyek->sumber_dana }}</td>
                        <td>{{ $proyek->deskripsi ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Belum ada data proyek</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
