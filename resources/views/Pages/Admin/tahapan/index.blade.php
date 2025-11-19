@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Daftar Tahapan Proyek</h2>

    <div class="mb-3 text-end">
        <a href="{{ route('tahapan.create') }}" class="btn btn-primary">Tambah Tahapan</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Proyek</th>
                <th>Nama Tahap</th>
                <th>Target (%)</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        @forelse($tahapan as $index => $t)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $t->proyek->nama_proyek }}</td>
                <td>{{ $t->nama_tahap }}</td>
                <td>{{ $t->target_persen }}</td>
                <td>{{ $t->tgl_mulai }}</td>
                <td>{{ $t->tgl_selesai }}</td>
                <td>
                    <a href="{{ route('tahapan.show', $t->tahap_id) }}" class="btn btn-info btn-sm">Lihat</a>
                    <a href="{{ route('tahapan.edit', $t->tahap_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('tahapan.destroy', $t->tahap_id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center text-muted">Belum ada tahapan proyek</td>
            </tr>
        @endforelse
        </tbody>

    </table>
</div>
@endsection
