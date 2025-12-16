@extends('layouts.admin.app')

@section('content')
    <div class="content">
        <div class="container-fluid pt-4 px-4">
            <div class="bg-dark text-light rounded p-4">
                <h4 class="text-white mb-4">Detail User</h4>

                <table class="table table-dark table-bordered">
                    <tr>
                        <th>ID</th>
                        <td>{{ $user->id }}</td>
                    </tr>

                    <tr>
                        <th>Foto Profil</th>
                        <td>
                            @php
                                $mediaFoto = $user->media ? asset($user->media->file_url) : null;
                                $profileFoto = $user->profile_picture
                                    ? asset('storage/' . $user->profile_picture)
                                    : null;
                                $defaultFoto = asset('asset-admin/img/default-avatar.png');
                                $foto = $mediaFoto ?? ($profileFoto ?? $defaultFoto);
                            @endphp

                            <img src="{{ $foto }}" alt="Foto Profil" width="120" class="rounded">
                        </td>
                    </tr>

                    <tr>
                        <th>Nama</th>
                        <td>{{ $user->name }}</td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>

                    <tr>
                        <th>Role</th>
                        <td>{{ $user->role }}</td>
                    </tr>

                    <tr>
                        <th>Dibuat Pada</th>
                        <td>{{ $user->created_at->format('d M Y H:i') }}</td>
                    </tr>

                    <tr>
                        <th>Terakhir Diperbarui</th>
                        <td>{{ $user->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                </table>

                <div class="mt-3">
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                </div>
            </div>
        </div>
    </div>
@endsection
