@extends('layouts.admin.app')

@section('content')
    <div class="container mt-4">

        <h2 class="mb-4 text-center">Detail Kontraktor</h2>

        {{-- TOMBOL TAMBAH (ADMIN + STAFF) --}}
        @if (in_array(auth()->user()->role, ['admin', 'staff']))
            <div class="mb-3 text-end">
                <a href="{{ auth()->user()->role === 'admin' ? route('kontraktor.create') : route('staff.kontraktor.create') }}"
                    class="btn btn-primary">
                    + Tambah Kontraktor
                </a>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- FILTER & SEARCH --}}
        <form method="GET"
            action="{{ auth()->user()->role === 'admin' ? route('kontraktor.index') : route('staff.kontraktor.index') }}"
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

                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search..."
                            value="{{ request('search') }}">
                        <button class="btn btn-primary">
                            <i class="bi bi-search"></i>
                        </button>

                        @if (request('search') || request('proyek_id'))
                            <a href="{{ auth()->user()->role === 'admin' ? route('kontraktor.index') : route('staff.kontraktor.index') }}"
                                class="btn btn-secondary">
                                Clear
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </form>

        {{-- TABLE --}}
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">

                <thead class="table-dark text-center">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Kontraktor</th>
                        <th>Proyek</th>
                        <th>Penanggung Jawab</th>
                        <th>Kontak</th>
                        <th>Alamat</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($kontraktors as $index => $kontraktor)
                        <tr>
                            <td class="text-center">
                                {{ $kontraktors->firstItem() + $index }}
                            </td>

                            {{-- DOKUMEN
                            <td class="text-center">
                                @if ($kontraktor->media && $kontraktor->media->count())
                                    <img src="{{ asset($kontraktor->media->first()->file_url) }}" width="45"
                                        height="45" class="border rounded" style="object-fit:cover">
                                @else
                                    <img src="{{ asset('asset-admin/img/default-avatar.png') }}" width="45"
                                        height="45" class="border rounded opacity-75" style="object-fit:cover">
                                @endif
                            </td> --}}

                            <td>{{ $kontraktor->nama }}</td>
                            <td>{{ $kontraktor->proyek->nama_proyek ?? '-' }}</td>
                            <td>{{ $kontraktor->penanggung_jawab }}</td>
                            <td>{{ $kontraktor->kontak }}</td>
                            <td class="text-start">{{ $kontraktor->alamat }}</td>

                            {{-- AKSI --}}
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">

                                    {{-- LIHAT (SEMUA ROLE) --}}
                                    <a href="{{ auth()->user()->role === 'admin'
                                        ? route('kontraktor.show', $kontraktor->kontraktor_id)
                                        : (auth()->user()->role === 'staff'
                                            ? route('staff.kontraktor.show', $kontraktor->kontraktor_id)
                                            : route('view.kontraktor.show', $kontraktor->kontraktor_id)) }}"
                                        class="btn btn-info btn-sm" title="Lihat">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    {{-- EDIT (ADMIN ONLY) --}}
                                    @if (auth()->user()->role === 'admin')
                                        <a href="{{ route('kontraktor.edit', $kontraktor->kontraktor_id) }}"
                                            class="btn btn-warning btn-sm" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    @endif

                                    {{-- HAPUS (ADMIN ONLY) --}}
                                    @if (auth()->user()->role === 'admin')
                                        <form action="{{ route('kontraktor.destroy', $kontraktor->kontraktor_id) }}"
                                            method="POST" onsubmit="return confirm('Yakin hapus kontraktor ini?')">
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
                                Belum ada data kontraktor
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $kontraktors->links('pagination::simple-bootstrap-5') }}

    </div>
@endsection
