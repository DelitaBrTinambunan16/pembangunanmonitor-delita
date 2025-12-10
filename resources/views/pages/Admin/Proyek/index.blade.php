@extends('layouts.admin.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Daftar Proyek</h2>

        <div class="mb-3 text-end">
            <a href="{{ route('proyek.create') }}" class="btn btn-primary">Tambah Proyek</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- FILTER TAHUN & SEARCH --}}
        <form method="GET" action="{{ route('proyek.index') }}" class="mb-3">
            <div class="row">
                {{-- FILTER TAHUN --}}
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

                {{-- SEARCH --}}
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                            value="{{ request('search') }}" placeholder="Search...">

                        <button type="submit" class="btn btn-primary d-flex align-items-center px-3">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        {{-- SEARCH CLEAR --}}
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
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr class="text-center">
                    <th style="width: 50px">No</th>
                    <th>Kode Proyek</th>
                    <th>Nama Proyek</th>
                    <th>Tahun</th>
                    <th>Lokasi</th>
                    <th>Anggaran</th>
                    <th style="width: 200px">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($proyeks as $index => $p)
                    <tr class="align-middle">
                        <td class="text-center">
                            {{ $proyeks->firstItem() + $index }}
                        </td>

                        <td>{{ $p->kode_proyek }}</td>
                        <td>{{ $p->nama_proyek }}</td>
                        <td>{{ $p->tahun }}</td>
                        <td>{{ $p->lokasi }}</td>
                        <td>Rp {{ number_format($p->anggaran, 0, ',', '.') }}</td>

                        <td>
                            <div class="d-flex gap-1 justify-content-center">
                                <a href="{{ route('proyek.show', $p->proyek_id) }}" class="btn btn-info btn-sm">Lihat</a>
                                <a href="{{ route('proyek.edit', $p->proyek_id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('proyek.destroy', $p->proyek_id) }}" method="POST">
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
                            Belum ada data proyek
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- PAGINATION SIMPLE BOOTSTRAP 5 --}}
        <div class="mt-3">
            {{ $proyeks->links('pagination::simple-bootstrap-5') }}
        </div>
    </div>
@endsection
