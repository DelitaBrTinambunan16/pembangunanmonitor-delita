@extends('layouts.admin.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4 text-center">Detail User</h2>

    {{-- TAMBAH USER --}}
    <div class="mb-3 text-end">
        <a href="{{ route('user.create') }}" class="btn btn-primary">
            + Tambah User
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- FILTER + SEARCH --}}
    <form method="GET" action="{{ route('user.index') }}" class="mb-3">
        <div class="row g-2">

            <div class="col-md-3">
                <input type="text" name="email"
                       class="form-control"
                       placeholder="Cari Email..."
                       value="{{ request('email') }}">
            </div>

            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" name="search"
                           class="form-control"
                           placeholder="Search"
                           value="{{ request('search') }}">
                    <button class="btn btn-primary">Cari</button>
                </div>
            </div>

        </div>
    </form>

    {{-- TABLE --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle text-center">

            <thead class="table-dark">
                <tr>
                    <th width="60">No</th>
                    <th width="80">Foto</th>
                    <th width="180">Nama</th>
                    <th width="260">Email</th>
                    <th width="120">Role</th>
                    <th width="120">Dibuat</th>
                    <th width="160">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse ($users as $index => $user)

                @php
                    $fotoUser = \App\Models\Media::where('ref_table', 'users')
                        ->where('ref_id', $user->id)
                        ->first();

                    $foto = $fotoUser
                        ? asset($fotoUser->file_url)
                        : asset('asset-admin/img/default-avatar.png');

                    $badgeRole = match ($user->role) {
                        'admin' => 'bg-danger',
                        'staff' => 'bg-warning',
                        default => 'bg-primary',
                    };
                @endphp

                <tr>
                    <td>{{ $users->firstItem() + $index }}</td>

                    {{-- FOTO --}}
                    <td>
                        <img src="{{ $foto }}"
                             class="rounded-circle"
                             width="40" height="40"
                             style="object-fit:cover">
                    </td>

                    {{-- NAMA --}}
                    <td class="text-start">{{ $user->name }}</td>

                    {{-- EMAIL --}}
                    <td class="text-start">
                        <div class="text-truncate" style="max-width:260px;">
                            {{ $user->email }}
                        </div>
                    </td>

                    {{-- ROLE --}}
                    <td>
                        <span class="badge {{ $badgeRole }} px-3 py-1 text-capitalize">
                            {{ $user->role }}
                        </span>
                    </td>

                    {{-- DIBUAT --}}
                    <td>{{ $user->created_at->format('d-m-Y') }}</td>

                    {{-- AKSI --}}
                    <td>
                        <div class="d-flex justify-content-center gap-1">

                            <a href="{{ route('user.show', $user->id) }}"
                               class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i>
                            </a>

                            <a href="{{ route('user.edit', $user->id) }}"
                               class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('user.destroy', $user->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus user ini?')">
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
                    <td colspan="7" class="text-center text-muted">
                        Belum ada data user
                    </td>
                </tr>
            @endforelse
            </tbody>

        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-3">
        {{ $users->links('pagination::simple-bootstrap-5') }}
    </div>

</div>
@endsection
