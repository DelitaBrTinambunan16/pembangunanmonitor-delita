@extends('layouts.admin.app')

@section('content')
<div class="container mt-4">

    {{-- ================= JUDUL ================= --}}
    <h4 class="mb-4 text-center fw-bold">Data Lokasi Proyek</h4>

    {{-- ================= AKSI ATAS ================= --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div></div>
        <a href="{{ route('lokasi.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Lokasi
        </a>
    </div>

    {{-- ================= ALERT ================= --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- ================= FILTER & SEARCH ================= --}}
    <form method="GET" action="{{ route('lokasi.index') }}" class="mb-3">
        <div class="row g-2 align-items-center">

            <div class="col-md-3">
                <select name="proyek_id" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Proyek</option>
                    @foreach ($proyekList as $proyek)
                        <option value="{{ $proyek->proyek_id }}"
                            {{ request('proyek_id') == $proyek->proyek_id ? 'selected' : '' }}>
                            {{ $proyek->nama_proyek }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-5">
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                           placeholder="Cari GeoJSON / Koordinat..."
                           value="{{ request('search') }}">
                    <button class="btn btn-primary">
                        <i class="bi bi-search"></i>
                    </button>

                    @if(request('search') || request('proyek_id'))
                        <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">
                            Clear
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </form>

    {{-- ================= TABEL ================= --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th width="50">No</th>
                    <th width="80">Dokumen</th>
                    <th>Proyek</th>
                    <th width="120">Latitude</th>
                    <th width="120">Longitude</th>
                    <th>GeoJSON</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($lokasis as $index => $l)
                <tr>

                    <td class="text-center">
                        {{ $lokasis->firstItem() + $index }}
                    </td>

                    {{-- DOKUMEN --}}
                    <td class="text-center">
                        @if($l->media && $l->media->count())
                            <img src="{{ asset(
                                'storage/uploads/'.$l->media->first()->ref_table.'/'.$l->media->first()->file_url
                            ) }}"
                                 width="45" height="45"
                                 class="border rounded"
                                 style="object-fit:cover">
                        @else
                            <img src="{{ asset('asset-admin/img/default-avatar.png') }}"
                                 width="45" height="45"
                                 class="border rounded opacity-75"
                                 style="object-fit:cover">
                        @endif
                    </td>

                    <td>{{ $l->proyek->nama_proyek ?? '-' }}</td>

                    <td class="text-center">{{ $l->lat }}</td>
                    <td class="text-center">{{ $l->lng }}</td>

                    <td>{{ Str::limit($l->geojson, 50) }}</td>

                    {{-- AKSI --}}
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">

                            <a href="{{ route('lokasi.show', $l->lokasi_id) }}"
                               class="btn btn-info btn-sm" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>

                            <a href="{{ route('lokasi.edit', $l->lokasi_id) }}"
                               class="btn btn-warning btn-sm" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('lokasi.destroy', $l->lokasi_id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin hapus lokasi ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">
                        Belum ada data lokasi proyek
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- ================= PAGINATION ================= --}}
    <div class="d-flex justify-content-end mt-3">
        {{ $lokasis->links('pagination::simple-bootstrap-5') }}
    </div>

</div>
@endsection
