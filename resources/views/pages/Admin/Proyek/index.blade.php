@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Daftar Proyek</h2>

    <div class="mb-3 text-end">
        <a href="{{ route('proyek.create') }}" class="btn btn-primary">+ Tambah Proyek</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">

        {{-- FILTER SUMBER DANA --}}
        <form method="GET" action="{{ route('proyek.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-2">
                    <select name="sumber_dana" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Dana</option>
                        <option value="APBD" {{ request('sumber_dana') == 'APBD' ? 'selected' : '' }}>APBD</option>
                        <option value="APBN" {{ request('sumber_dana') == 'APBN' ? 'selected' : '' }}>APBN</option>
                        <option value="Dana Desa" {{ request('sumber_dana') == 'Dana Desa' ? 'selected' : '' }}>Dana Desa</option>
                        <option value="CSR" {{ request('sumber_dana') == 'CSR' ? 'selected' : '' }}>CSR</option>
                    </select>
                </div>

                {{-- SEARCH --}}
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" id="exampleInputIconRight"
                            value="{{ request('search') }}" placeholder="Search" aria-label="Search">
                        <button type="submit" class="input-group-text" id="basic-addon2">
                            <svg class="icon icon-xxs" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        {{-- CLEAR SEARCH --}}
                        @if (request('search'))
                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                class="btn btn-secondary text-white" id="clear-search"> Clear</a>
                        @endif
                    </div>
                </div>
            </div>
        </form>

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
                                <a href="{{ route('proyek.show', $p->proyek_id) }}" class="btn btn-info btn-sm">Lihat</a>
                                <a href="{{ route('proyek.edit', $p->proyek_id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('proyek.destroy', $p->proyek_id) }}" method="POST"
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

        {{-- pagination simple bootstrap 5 --}}
        <div class="mt-3">
            {{ $proyek->links('pagination::simple-bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
