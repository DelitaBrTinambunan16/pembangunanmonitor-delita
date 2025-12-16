@extends('layouts.admin.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4 text-center">Daftar Warga</h2>

    {{-- TOMBOL TAMBAH --}}
    <div class="mb-3 text-end">
        @if(in_array(auth()->user()->role, ['admin','staff']))
            <a href="{{ route('warga.create') }}" class="btn btn-primary">
                + Tambah Warga
            </a>
        @endif
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- FILTER & SEARCH --}}
    <form method="GET" action="{{ route('warga.index') }}" class="mb-3">
        <div class="row g-2">
            <div class="col-md-2">
                <select name="jenis_kelamin" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua</option>
                    <option value="Perempuan" {{ request('jenis_kelamin')=='Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    <option value="Laki-laki" {{ request('jenis_kelamin')=='Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                </select>
            </div>

            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                           value="{{ request('search') }}"
                           placeholder="Cari nama / email / telp">

                    <button class="btn btn-primary">Cari</button>

                    @if(request('search'))
                        <a href="{{ route('warga.index') }}" class="btn btn-secondary">
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
                    <th width="60">No</th>
                    <th width="140">No KTP</th>
                    <th width="170">Nama</th>
                    <th width="120">Jenis Kelamin</th>
                    <th width="120">Agama</th>
                    <th width="160">Pekerjaan</th>
                    <th width="120">Telp</th>
                    <th width="180">Email</th>
                    <th width="160">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($warga as $index => $w)
                <tr>
                    <td>{{ $warga->firstItem() + $index }}</td>
                    <td>{{ $w->no_ktp }}</td>
                    <td>{{ $w->nama }}</td>
                    <td>{{ $w->jenis_kelamin }}</td>
                    <td>{{ $w->agama }}</td>
                    <td>{{ $w->pekerjaan }}</td>
                    <td>{{ $w->telp }}</td>
                    <td>{{ $w->email }}</td>

                    {{--  AKSI  --}}
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">

                            {{-- LIHAT --}}
                            <a href="{{ route('warga.show', $w->warga_id) }}"
                               class="btn btn-info btn-sm"
                               title="Lihat">
                                <i class="bi bi-eye"></i>
                            </a>

                            {{-- EDIT --}}
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('warga.edit', $w->warga_id) }}"
                                   class="btn btn-warning btn-sm"
                                   title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            @endif

                            {{-- HAPUS --}}
                            @if(auth()->user()->role === 'admin')
                                <form action="{{ route('warga.destroy', $w->warga_id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin hapus data ini?')">
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
                    <td colspan="9" class="text-center text-muted">
                        Belum ada data warga
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $warga->links('pagination::simple-bootstrap-5') }}
</div>
@endsection
