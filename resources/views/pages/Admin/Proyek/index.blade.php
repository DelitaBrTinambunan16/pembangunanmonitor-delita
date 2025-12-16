@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Detail Proyek</h2>

    <div class="mb-3 text-end">
        <a href="{{ route('proyek.create') }}" class="btn btn-primary">Tambah Proyek</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- FILTER TAHUN & SEARCH --}}
    <form method="GET" action="{{ route('proyek.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <select name="tahun" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Tahun</option>
                    @foreach ($tahunList as $tahun)
                        <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                            {{ $tahun }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                           value="{{ request('search') }}" placeholder="Search...">
                    <button type="submit" class="btn btn-primary px-3">Cari</button>

                    @if (request('search'))
                        <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                           class="btn btn-secondary text-white">
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
            <thead class="table-dark">
                <tr class="text-center">
                    <th style="width:50px">No</th>
                    <th style="width:80px">Dokumen</th>
                    <th>Kode Proyek</th>
                    <th>Nama Proyek</th>
                    <th>Tahun</th>
                    <th>Anggaran</th>
                    <th style="width:200px">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($proyeks as $index => $p)
                    <tr>
                        <td class="text-center">
                            {{ $proyeks->firstItem() + $index }}
                        </td>

                        {{--  DOKUMEN --}}
                        <td class="text-center">
                            @if ($p->media->count())
                                <img src="{{ asset($p->media->first()->file_url) }}"
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

                        <td>{{ $p->kode_proyek }}</td>
                        <td>{{ $p->nama_proyek }}</td>
                        <td>{{ $p->tahun }}</td>
                        <td>Rp {{ number_format($p->anggaran, 0, ',', '.') }}</td>

   <td class="text-center">
    <div class="d-flex justify-content-center gap-1">

        <a href="{{ route('proyek.show', $p->proyek_id) }}"
           class="btn btn-info btn-sm"
           title="Lihat">
            <i class="bi bi-eye"></i>
        </a>

        <a href="{{ route('proyek.edit', $p->proyek_id) }}"
           class="btn btn-warning btn-sm"
           title="Edit">
            <i class="bi bi-pencil-square"></i>
        </a>

        <form action="{{ route('proyek.destroy', $p->proyek_id) }}"
              method="POST"
              onsubmit="return confirm('Yakin hapus proyek ini?')">
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
                            Belum ada data proyek
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $proyeks->links('pagination::simple-bootstrap-5') }}
    </div>
</div>
@endsection
