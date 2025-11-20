@extends('layouts.admin.app')

@section('content')

<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Daftar Warga</h2>

        <div class="mb-3 text-end">
            <a href="{{ route('warga.create') }}" class="btn btn-primary">+ Tambah Warga</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>No KTP</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>Pekerjaan</th>
                    <th>Telp</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($warga as $index => $w)
                    <tr>
                        <td>{{ $warga->firstItem() + $index }}</td>
                        <td>{{ $w->no_ktp }}</td>
                        <td>{{ $w->nama }}</td>
                        <td>{{ $w->jenis_kelamin }}</td>
                        <td>{{ $w->agama }}</td>
                        <td>{{ $w->pekerjaan }}</td>
                        <td>{{ $w->telp }}</td>
                        <td>{{ $w->email }}</td>

                        <td>
                            <div class="aksi-btn">
                                <a href="{{ route('warga.show', $w->warga_id) }}" class="btn btn-info btn-sm">Lihat</a>

                                <a href="{{ route('warga.edit', $w->warga_id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('warga.destroy', $w->warga_id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus data ini?')" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">Belum ada data warga</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $warga->links('pagination::simple-bootstrap-5') }}
    </div>

    {{-- CSS Agar Tombol Aksi Berjajar Rapi --}}
    <style>
        .aksi-btn {
            display: flex !important;
            gap: 6px;
            align-items: center;
            flex-wrap: nowrap;
        }

        .aksi-btn a,
        .aksi-btn form {
            display: inline-block !important;
        }
    </style>

</body>
@endsection
