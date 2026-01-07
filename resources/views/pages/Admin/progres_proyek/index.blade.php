@extends('layouts.admin.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 text-center">Detail Progres Proyek</h2>

        {{-- ===== TOMBOL TAMBAH (ADMIN & STAFF) ===== --}}
        @if (in_array(auth()->user()->role, ['admin', 'staff']))
            <div class="mb-3 text-end">
                <a href="{{ auth()->user()->role === 'admin' ? route('progres_proyek.create') : route('staff.progres_proyek.create') }}"
                    class="btn btn-primary">
                    + Tambah Progres
                </a>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- FILTER & SEARCH --}}
        <form method="GET"
            action="{{ auth()->user()->role === 'admin' ? route('progres_proyek.index') : route('staff.progres_proyek.index') }}"
            class="mb-3">

            <div class="row g-2">
                <div class="col-md-3">
                    <select name="proyek_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Proyek</option>
                        @foreach ($proyeks as $proyek)
                            <option value="{{ $proyek->proyek_id }}"
                                {{ request('proyek_id') == $proyek->proyek_id ? 'selected' : '' }}>
                                {{ $proyek->nama_proyek }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                            placeholder="Search catatan...">
                        <button class="btn btn-primary">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>

        {{-- TABLE --}}
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th width="60">No</th>
                        <th width="80">Dokumen</th>
                        <th>Proyek</th>
                        <th>Tahap</th>
                        <th>Persen (%)</th>
                        <th>Tanggal</th>
                        <th>Catatan</th>
                        <th width="170" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($progres as $index => $p)
                        <tr>
                            <td>{{ $progres->firstItem() + $index }}</td>

                            {{-- DOKUMEN --}}
                            <td class="text-center">
                                @if ($p->media->count())
                                    <img src="{{ asset($p->media->first()->file_url) }}" width="45" height="45"
                                        class="rounded" style="object-fit:cover">
                                @else
                                    <img src="{{ asset('asset-admin/img/default-avatar.png') }}" width="45"
                                        height="45" class="rounded opacity-75" style="object-fit:cover">
                                @endif
                            </td>

                            <td>{{ $p->proyek->nama_proyek ?? '-' }}</td>
                            <td>{{ $p->tahapan->nama_tahap ?? '-' }}</td>
                            <td>{{ $p->persen_real }}%</td>
                            <td>{{ $p->tanggal }}</td>
                            <td>{{ $p->catatan }}</td>

                            {{-- ===== AKSI ===== --}}
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">

                                    {{-- LIHAT (SEMUA ROLE) --}}
                                    <a href="{{ auth()->user()->role === 'admin'
                                        ? route('progres_proyek.show', $p->progres_id)
                                        : (auth()->user()->role === 'staff'
                                            ? route('staff.progres_proyek.show', $p->progres_id)
                                            : route('view.progres_proyek.show', $p->progres_id)) }}"
                                        class="btn btn-info btn-sm" title="Lihat">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    {{-- EDIT (ADMIN ONLY) --}}
                                    @if (auth()->user()->role === 'admin')
                                        <a href="{{ route('progres_proyek.edit', $p->progres_id) }}"
                                            class="btn btn-warning btn-sm" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    @endif

                                    {{-- HAPUS (ADMIN ONLY) --}}
                                    @if (auth()->user()->role === 'admin')
                                        <form action="{{ route('progres_proyek.destroy', $p->progres_id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus progres ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                Belum ada data progres
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $progres->links('pagination::simple-bootstrap-5') }}
        </div>
    </div>
@endsection
