@extends('layouts.admin.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Daftar Lokasi Proyek</h2>

    <div class="mb-3 text-end">
        <a href="{{ route('lokasi.create') }}" class="btn btn-primary">+ Tambah Lokasi</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- FILTER DAN SEARCH --}}
    <form method="GET" action="{{ route('lokasi.index') }}" class="mb-3">

        <div class="row g-2">

            {{-- Filter Proyek --}}
            <div class="col-md-3">
                <select name="proyek_id" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Semua Proyek --</option>
                    @foreach ($proyekList as $proyek)
                        <option value="{{ $proyek->proyek_id }}"
                            {{ request('proyek_id') == $proyek->proyek_id ? 'selected' : '' }}>
                            {{ $proyek->nama_proyek }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Search --}}
            <div class="col-md-3">
                <div class="input-group">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        value="{{ request('search') }}"
                        placeholder="Cari lokasi...">

                    <button type="submit" class="btn btn-primary px-3">
                        <i class="fa fa-search"></i>
                    </button>

                    @if (request('search') || request('proyek_id'))
                        <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">Clear</a>
                    @endif
                </div>
            </div>

        </div>

    </form>

    {{-- TABEL LIST --}}
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Proyek</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>GeoJSON</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($lokasis as $index => $l)
                <tr>
                    <td>{{ $lokasis->firstItem() + $index }}</td>
                    <td>{{ $l->proyek->nama_proyek ?? '-' }}</td>
                    <td>{{ $l->lat }}</td>
                    <td>{{ $l->lng }}</td>
                    <td>{{ Str::limit($l->geojson, 60) }}</td>

                    <td>
                        <a href="{{ route('lokasi.show', $l->lokasi_id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('lokasi.edit', $l->lokasi_id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('lokasi.destroy', $l->lokasi_id) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada data lokasi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-3">
        {{ $lokasis->links('pagination::simple-bootstrap-5') }}
    </div>

</div>
@endsection
