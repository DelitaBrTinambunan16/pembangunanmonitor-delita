@extends('layouts.admin.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4 text-center">Daftar Proyek</h2>

    <div class="mb-3 text-end">
        <a href="{{ route('proyek.create') }}" class="btn btn-primary">+ Tambah Proyek</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Proyek</th>
                    <th>Lokasi</th>
                    <th>Anggaran</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Status</th>
                    <th style="width: 180px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($proyeks as $index => $proyek)
                    <tr class="align-middle text-center">
                        <td>{{ $proyeks->firstItem() + $index }}</td>
                        <td>{{ $proyek->nama_proyek }}</td>
                        <td>{{ $proyek->lokasi }}</td>
                        <td>Rp{{ number_format($proyek->anggaran, 0, ',', '.') }}</td>
                        <td>{{ $proyek->tanggal_mulai }}</td>
                        <td>{{ $proyek->tanggal_selesai }}</td>
                        <td>{{ $proyek->status }}</td>

                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('proyek.show', $proyek->proyek_id) }}" class="btn btn-info btn-sm">Lihat</a>
                                <a href="{{ route('proyek.edit', $proyek->proyek_id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('proyek.destroy', $proyek->proyek_id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin hapus proyek ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Belum ada data proyek</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $proyeks->links('pagination::simple-bootstrap-5') }}
    </div>
</div>
@endsection
