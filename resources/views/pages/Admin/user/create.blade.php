@extends('layouts.admin.app')

@section('content')

<div class="container mt-5">
    <h2 class="mb-4 text-center">Tambah Data User</h2>

    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- NAMA --}}
        <div class="mb-3">
            <label class="fw-semibold">Nama</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name') }}" required>

            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- EMAIL --}}
        <div class="mb-3">
            <label class="fw-semibold">Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email') }}" required>

            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- ROLE --}}
        <div class="mb-3">
            <label class="fw-semibold">Role</label>
            <select name="role" class="form-control" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                <option value="user"  {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
            </select>

            @error('role')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- PASSWORD --}}
        <div class="mb-3">
            <label class="fw-semibold">Password</label>
            <input type="password" name="password" class="form-control" required>

            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- FOTO PROFIL --}}
        <div class="mb-3">
            <label class="fw-semibold">Foto Profil (Opsional)</label>
            <input type="file" name="profile_picture" class="form-control"
                   accept="image/png, image/jpeg, image/jpg">
            <small class="text-muted">Format: JPG, JPEG, PNG. Maks 5MB.</small>

            @error('profile_picture')
                <small class="text-danger d-block">{{ $message }}</small>
            @enderror
        </div>

        <div class="text-end mt-4">
            <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>

    </form>
</div>

@endsection
