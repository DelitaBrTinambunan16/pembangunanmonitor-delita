@extends('Layouts.Admin.app')

@section('content')
<div class="content">
    <div class="container-fluid pt-4 px-4">
        <div class="bg-dark text-light rounded p-4">
            <h4 class="text-white mb-4">Detail Proyek</h4>

            <table class="table table-dark table-bordered">
                <tr>
                    <th>Kode Proyek</th>
                    <td>{{ $proyek->kode_proyek }}</td>
                </tr>
                <tr>
                    <th>Nama Proyek</th>
                    <td>{{ $proyek->nama_proyek }}</td>
                </tr>
                <tr>
                    <th>Tahun</th>
                    <td>{{ $proyek->tahun }}</td>
                </tr>
                <tr>
                    <th>Lokasi</th>
                    <td>{{ $proyek->lokasi }}</td>
                </tr>
                <tr>
                    <th>Anggaran</th>
                    <td>Rp {{ number_format($proyek->anggaran, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Sumber Dana</th>
                    <td>{{ $proyek->sumber_dana }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $proyek->deskripsi ?? '-' }}</td>
                </tr>
            </table>

            <div class="mt-3">
                <a href="{{ route('proyek.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
