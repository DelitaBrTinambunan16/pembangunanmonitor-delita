@extends('layouts.admin.app')

@section('content')

<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Data User</h2>

    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- NAMA --}}
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        {{-- EMAIL --}}
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        {{-- ROLE --}}
        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>

        {{-- PASSWORD --}}
        <div class="mb-3">
            <label>Password (biarkan kosong jika tidak diubah)</label>
            <input type="password" name="password" class="form-control">
        </div>

        {{-- FOTO PROFIL --}}
        <div class="mb-3">
            <label class="fw-semibold">Foto Profil (Opsional)</label>
            <input type="file" name="profile_picture" class="form-control"
                accept="image/png, image/jpeg, image/jpg, image/webp">
            <small class="text-muted">Format: JPG, JPEG, PNG, WEBP. Maks 5MB.</small>

            {{-- Preview foto lama --}}
            @if ($user->profile_picture)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" width="120" class="rounded">
                </div>
            @endif

            @error('profile_picture')
                <small class="text-danger d-block">{{ $message }}</small>
            @enderror
        </div>

        <div class="text-end">
            <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </form>
</div>

@endsection
