@extends('layouts.admin.app')

@section('content')

    <body>
        <div class="container mt-5">
            <h2 class="mb-4 text-center">Daftar Warga</h2>

            <div class="mb-3 text-end">
                <a href="{{ route('warga.create') }}" class="btn btn-primary">+ Tambah Warga</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">

                {{-- FILTER JENIS KELAMIN --}}
                <form method="GET" action="{{ route('warga.index') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-2">
                            <select name="jenis_kelamin" class="form-select" onchange="this.form.submit()">
                                <option value="">All</option>
                                <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                                <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>
                            </select>
                        </div>
                        {{-- SEARCH TOMBOL --}}
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" id="exampleInputIconRight"
                                    value="{{ request('search') }}" placeholder="Search" aria-label="Search">
                                <button type="submit" class="btn btn-primary d-flex align-items-center px-3"
                                    id="basic-addon2">
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
                        <tr>
                            <th>No</th>
                            <th>No KTP</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Pekerjaan</th>
                            <th>Telp</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($warga as $index => $w)
                            <tr>
                                <td>{{ $warga->firstItem() + $index }}</td>
                                <td>{{ $w->no_ktp }}</td>
                                <td>{{ $w->nama }}</td>
                                <td>{{ $w->jenis_kelamin }}</td>
                                <td>{{ $w->agama }}</td>
                                <td>{{ $w->pekerjaan }}</td>
                                <td>{{ $w->telp }}</td>
                                <td>{{ $w->email }}</td>

                                <td class="text-center">
                                    <div class="d-flex gap-2 justify-content-center">

                                        <a href="{{ route('warga.show', $w->warga_id) }}" class="btn btn-info btn-sm">
                                            Lihat
                                        </a>

                                        <a href="{{ route('warga.edit', $w->warga_id) }}" class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('warga.destroy', $w->warga_id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Hapus</button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">Belum ada data warga</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $warga->links('pagination::simple-bootstrap-5') }}
                </div>

            </div>
        </div>
    </body>
@endsection
