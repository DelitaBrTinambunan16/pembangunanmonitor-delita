@extends('layouts.admin.app')

@section('content')

<div class="container mt-5">
    <h2 class="mb-4 text-center">Daftar User</h2>

    <div class="mb-3 text-end">
        <a href="{{ route('user.create') }}" class="btn btn-primary">+ Tambah User</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- FILTER --}}
    <form method="GET" action="{{ route('user.index') }}" class="mb-3">
        <div class="row">

            {{-- FILTER EMAIL --}}
            <div class="col-md-3">
                <input type="text" name="email" class="form-control"
                       placeholder="Cari Email..."
                       value="{{ request('email') }}"
                       onchange="this.form.submit()">
            </div>

            {{-- SEARCH --}}
            <div class="col-md-3">
                <div class="input-group">

                    <input type="text" name="search" class="form-control"
                           value="{{ request('search') }}" placeholder="Search">

                    <button type="submit" class="btn btn-primary d-flex align-items-center px-3">
                        <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>

                    {{-- CLEAR --}}
                    @if (request('search'))
                        <a href="{{ route('user.index', array_merge(request()->except('search'))) }}"
                           class="btn btn-secondary text-white">
                            Clear
                        </a>
                    @endif

                </div>
            </div>

        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Tanggal Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    {{-- FOTO USER --}}
                    <td>
                        @php
                            // 1. Foto dari tabel media
                            $mediaFoto = $user->media
                                ? asset($user->media->file_url)
                                : null;

                            // 2. Foto dari kolom profile_picture
                            $profileFoto = $user->profile_picture
                                ? asset('storage/' . $user->profile_picture)
                                : null;

                            // 3. Default
                            $defaultFoto = asset('assets/default-avatar.png');

                            // FINAL FOTO (prioritas: media -> profile -> default)
                            $foto = $mediaFoto ?? $profileFoto ?? $defaultFoto;
                        @endphp

                        <img src="{{ $foto }}" alt="Avatar"
                            class="rounded-circle"
                            width="50" height="50"
                            style="object-fit: cover;">
                    </td>

                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->created_at->format('d-m-Y') }}</td>

                    <td>
                        <a href="{{ route('user.show', $user->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('user.destroy', $user->id) }}"
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus user ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada data user</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $users->links('pagination::simple-bootstrap-5') }}
    </div>

</div>

@endsection
