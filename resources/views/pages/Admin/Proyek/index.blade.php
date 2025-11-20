@extends('layouts.admin.app')

@section('content')

<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Daftar Proyek</h2>

        <div class="mb-3 text-end">
            <a href="{{ route('proyek.create') }}" class="btn btn-primary">+ Tambah Proyek</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Kode Proyek</th>
                    <th>Nama Proyek</th>
                    <th>Tahun</th>
                    <th>Lokasi</th>
                    <th>Anggaran</th>
                    <th>Sumber Dana</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($proyek as $index => $p)
                    <tr>
                        <td>{{ $proyek->firstItem() + $index }}</td>
                        <td>{{ $p->kode_proyek }}</td>
                        <td>{{ $p->nama_proyek }}</td>
                        <td>{{ $p->tahun }}</td>
                        <td>{{ $p->lokasi }}</td>
                        <td>Rp {{ number_format($p->anggaran, 2, ',', '.') }}</td>
                        <td>{{ $p->sumber_dana }}</td>
                        <td>{{ $p->deskripsi }}</td>

                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('proyek.show', $p->proyek_id) }}"
                                   class="btn btn-info btn-sm">Lihat</a>

                                <a href="{{ route('proyek.edit', $p->proyek_id) }}"
                                   class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('proyek.destroy', $p->proyek_id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">Belum ada data proyek</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $proyek->links('pagination::simple-bootstrap-5') }}
        </div>
    </div>
</body>
@endsection
