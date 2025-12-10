@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Daftar Kontraktor</h2>

    <div class="mb-3 text-end">
        <a href="{{ route('kontraktor.create') }}" class="btn btn-primary">+ Tambah Kontraktor</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- FILTER + SEARCH --}}
    <form method="GET" action="{{ route('kontraktor.index') }}" class="mb-3">
        <div class="row">

            {{-- Filter Proyek --}}
            <div class="col-md-3">
                <select name="proyek_id" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Proyek</option>
                    @foreach($proyeks as $proyek)
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
                    <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                        placeholder="Search">

                    <button type="submit" class="btn btn-primary d-flex align-items-center px-3">
                        <i class="fa fa-search"></i>
                    </button>

                    @if(request('search') || request('proyek_id'))
                        <a href="{{ route('kontraktor.index') }}" class="btn btn-secondary">Clear</a>
                    @endif
                </div>
            </div>

        </div>
    </form>

    {{-- TABEL --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Kontraktor</th>
                    <th>Proyek</th>
                    <th>Penanggung Jawab</th>
                    <th>Kontak</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($kontraktors as $index => $kontraktor)
                    <tr class="align-middle text-center">
                        <td>{{ $kontraktors->firstItem() + $index }}</td>
                        <td>{{ $kontraktor->nama }}</td>
                        <td>{{ $kontraktor->proyek->nama_proyek ?? '-' }}</td>
                        <td>{{ $kontraktor->penanggung_jawab }}</td>
                        <td>{{ $kontraktor->kontak }}</td>
                        <td>{{ $kontraktor->alamat }}</td>

                        {{-- Aksi --}}
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('kontraktor.show', $kontraktor->kontraktor_id) }}"
                                   class="btn btn-info btn-sm">Lihat</a>

                                <a href="{{ route('kontraktor.edit', $kontraktor->kontraktor_id) }}"
                                   class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('kontraktor.destroy', $kontraktor->kontraktor_id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin hapus kontraktor ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada data kontraktor</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $kontraktors->links('pagination::simple-bootstrap-5') }}
    </div>
</div>
@endsection
