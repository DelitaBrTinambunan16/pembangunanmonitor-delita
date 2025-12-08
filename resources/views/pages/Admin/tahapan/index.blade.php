@extends('layouts.admin.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Daftar Tahapan Proyek</h2>

        <div class="mb-3 text-end">
            <a href="{{ route('tahapan.create') }}" class="btn btn-primary">Tambah Tahapan</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        {{-- FILTER NAMA TAHAP --}}
        <form method="GET" action="{{ route('tahapan.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-3">
                    <select name="nama_tahap" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Tahap</option>

                        <option value="Perencanaan" {{ request('nama_tahap') == 'Perencanaan' ? 'selected' : '' }}>
                            Perencanaan</option>
                        <option value="Persiapan" {{ request('nama_tahap') == 'Persiapan' ? 'selected' : '' }}>Persiapan
                        </option>
                        <option value="Pelaksanaan" {{ request('nama_tahap') == 'Pelaksanaan' ? 'selected' : '' }}>
                            Pelaksanaan</option>
                        <option value="Pengawasan" {{ request('nama_tahap') == 'Pengawasan' ? 'selected' : '' }}>Pengawasan
                        </option>
                        <option value="Penyelesaian" {{ request('nama_tahap') == 'Penyelesaian' ? 'selected' : '' }}>
                            Penyelesaian</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" id="exampleInputIconRight"
                            value="{{ request('search') }}" placeholder="Search" aria-label="Search">
                        <button type="submit" class="btn btn-primary d-flex align-items-center px-3" id="basic-addon2">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd">
                                </path>
                            </svg>
                        </button>

                        {{-- {SEARCH CLEAR} --}}
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
                <tr class="text-center">
                    <th style="width: 50px">No</th>
                    <th>Nama Proyek</th>
                    <th>Nama Tahap</th>
                    <th>Target (%)</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th style="width: 200px">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($tahapan as $index => $t)
                    <tr class="align-middle">
                        {{-- Nomor berlanjut saat pagination --}}
                        <td class="text-center">
                            {{ $tahapan->firstItem() + $index }}
                        </td>

                        <td>{{ $t->proyek->nama_proyek }}</td>
                        <td>{{ $t->nama_tahap }}</td>
                        <td class="text-center">{{ $t->target_persen }}%</td>
                        <td>{{ $t->tgl_mulai }}</td>
                        <td>{{ $t->tgl_selesai }}</td>

                        {{-- Tombol Aksi dijamin sejajar --}}
                        <td>
                            <div class="d-flex gap-1 justify-content-center">

                                <a href="{{ route('tahapan.show', $t->tahap_id) }}" class="btn btn-info btn-sm">Lihat</a>

                                <a href="{{ route('tahapan.edit', $t->tahap_id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('tahapan.destroy', $t->tahap_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Belum ada tahapan proyek
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- PAGINATION SIMPLE BOOTSTRAP 5 --}}
        <div class="mt-3">
            {{ $tahapan->links('pagination::simple-bootstrap-5') }}
        </div>
    </div>
@endsection
