@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Detail Tahapan Proyek</h2>

    <div class="mb-3 text-end">
        <a href="{{ route('tahapan.create') }}" class="btn btn-primary">
            Tambah Tahapan
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- FILTER & SEARCH --}}
    <form method="GET" action="{{ route('tahapan.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <select name="nama_tahap" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Tahap</option>
                    @foreach (['Perencanaan','Persiapan','Pelaksanaan','Pengawasan','Penyelesaian'] as $nama)
                        <option value="{{ $nama }}" {{ request('nama_tahap') == $nama ? 'selected' : '' }}>
                            {{ $nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                           value="{{ request('search') }}" placeholder="Search...">
                    <button class="btn btn-primary px-3">
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
                <tr class="text-center">
                    <th width="50">No</th>
                    <th width="80">Dokumen</th>
                    <th>Nama Proyek</th>
                    <th>Nama Tahap</th>
                    <th width="110">Target (%)</th>
                    <th>Tgl Mulai</th>
                    <th>Tgl Selesai</th>
                    <th width="200">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($tahapan as $index => $t)
                <tr>
                    <td class="text-center">
                        {{ $tahapan->firstItem() + $index }}
                    </td>

                    {{-- DOKUMEN --}}
                    <td class="text-center">
                        @if($t->media->count())
                            <img src="{{ asset(
                                'storage/uploads/'.$t->media->first()->ref_table.'/'.$t->media->first()->file_url
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

                    <td>{{ $t->proyek->nama_proyek ?? '-' }}</td>
                    <td>{{ $t->nama_tahap }}</td>
                    <td class="text-center">{{ $t->target_persen }}%</td>
                    <td>{{ $t->tgl_mulai }}</td>
                    <td>{{ $t->tgl_selesai }}</td>

                    {{-- AKSI --}}
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('tahapan.show', $t->tahap_id) }}"
                               class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i>
                            </a>

                            <a href="{{ route('tahapan.edit', $t->tahap_id) }}"
                               class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('tahapan.destroy', $t->tahap_id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin hapus tahapan ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">
                        Belum ada tahapan proyek
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $tahapan->links('pagination::simple-bootstrap-5') }}
    </div>
</div>
@endsection
