@extends('layouts.admin.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Daftar Progres Proyek</h2>

    <div class="mb-3 text-end">
        <a href="{{ route('progres_proyek.create') }}" class="btn btn-primary">+ Tambah Progres</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- FILTER PROYEK & SEARCH --}}
    <form method="GET" action="{{ route('progres_proyek.index') }}" class="mb-3">
        <div class="row g-2">
            <div class="col-md-3">
                <select name="proyek_id" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Semua Proyek --</option>
                    @foreach ($proyeks as $proyek)
                        <option value="{{ $proyek->proyek_id }}" {{ request('proyek_id') == $proyek->proyek_id ? 'selected' : '' }}>
                            {{ $proyek->nama_proyek }}
                        </option>
                    @endforeach
                </select>
            </div>

                {{-- Search --}}
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                            placeholder="Search...">
                        <button type="submit" class="btn btn-primary d-flex align-items-center px-3">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                </div>
            </div>
        </div>
    </form>

    {{-- TABLE --}}
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Proyek</th>
                    <th>Tahap</th>
                    <th>Persen</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($progres as $index => $p)
                    <tr>
                        <td>{{ $progres->firstItem() + $index }}</td>
                        <td>{{ $p->proyek->nama_proyek ?? '-' }}</td>
                        <td>{{ $p->tahap->nama_tahap ?? '-' }}</td>
                        <td>{{ $p->persen_real }}%</td>
                        <td>{{ $p->tanggal }}</td>
                        <td>
                            <a href="{{ route('progres_proyek.show', $p->progres_id) }}" class="btn btn-info btn-sm">Lihat</a>
                            <a href="{{ route('progres_proyek.edit', $p->progres_id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('progres_proyek.destroy', $p->progres_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada data progres</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-3">
        {{ $progres->links('pagination::simple-bootstrap-5') }}
    </div>
</div>
@endsection
