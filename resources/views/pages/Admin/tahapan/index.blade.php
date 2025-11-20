@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Daftar Tahapan Proyek</h2>

    <div class="mb-3 text-end">
        <a href="{{ route('tahapan.create') }}" class="btn btn-primary">Tambah Tahapan</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr class="text-center">
                <th style="width: 50px">No</th>
                <th>Nama Proyek</th>
                <th>Nama Tahap</th>
                <th>Target (%)</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th style="width: 200px">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($tahapan as $index => $t)
                <tr class="align-middle">
                    {{-- Nomor berlanjut saat pagination --}}
                    <td class="text-center">
                        {{ $tahapan->firstItem() + $index }}
                    </td>

                    <td>{{ $t->proyek->nama_proyek }}</td>
                    <td>{{ $t->nama_tahap }}</td>
                    <td class="text-center">{{ $t->target_persen }}%</td>
                    <td>{{ $t->tgl_mulai }}</td>
                    <td>{{ $t->tgl_selesai }}</td>

                    {{-- Tombol Aksi dijamin sejajar --}}
                    <td>
                        <div class="d-flex gap-1 justify-content-center">

                            <a href="{{ route('tahapan.show', $t->tahap_id) }}"
                               class="btn btn-info btn-sm">Lihat</a>

                            <a href="{{ route('tahapan.edit', $t->tahap_id) }}"
                               class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('tahapan.destroy', $t->tahap_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus?')">
                                    Hapus
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">
                        Belum ada tahapan proyek
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $tahapan->links('pagination::simple-bootstrap-5') }}
    </div>
</div>
@endsection
