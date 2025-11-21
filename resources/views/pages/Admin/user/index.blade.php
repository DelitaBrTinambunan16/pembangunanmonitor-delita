@extends('layouts.admin.app')

@section('content')

    <body>
        <div class="container mt-5">
            <h2 class="mb-4 text-center">Daftar User</h2>

            <div class="mb-3 text-end">
                <a href="{{ route('user.create') }}" class="btn btn-primary">+ Tambah User</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            {{-- FILTER EMAIL --}}
            <form method="GET" action="{{ route('user.index') }}" class="mb-3">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="email" class="form-control" placeholder="Cari Email..."
                            value="{{ request('email') }}" onchange="this.form.submit()">

                        </select>
                    </div>
                </div>
            </form>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('user.show', $user->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data user</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
             <div class="mt-3">
            {{ $users->links('pagination::simple-bootstrap-5') }}
        </div>
    </body>
@endsection
