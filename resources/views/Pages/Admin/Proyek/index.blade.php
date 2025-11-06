@extends('Layouts.Admin.app')

@section('content')
<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Daftar Proyek</h2>

        <div class="mb-3 text-end">
            <a href="{{ route('proyek.create') }}" class="btn btn-primary">+ Tambah Proyek</a>
        </div>

        @if(session('success'))
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
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $p->kode_proyek }}</td>
                        <td>{{ $p->nama_proyek }}</td>
                        <td>{{ $p->tahun }}</td>
                        <td>{{ $p->lokasi }}</td>
                        <td>Rp {{ number_format($p->anggaran, 2, ',', '.') }}</td>
                        <td>{{ $p->sumber_dana }}</td>
                        <td>{{ $p->deskripsi }}</td>
                        <td>
                            <a href="{{ route('proyek.edit', $p->proyek_id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('proyek.destroy', $p->proyek_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">Belum ada data proyek</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
@endsection

