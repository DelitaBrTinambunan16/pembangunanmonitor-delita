@extends('layouts.admin.app')

@section('content')
<div class="container" style="max-width: 600px;">

    <h3 class="mb-4">Edit Profile</h3>

    {{-- Alert sukses --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form Update --}}
    <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Foto Profil --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Foto Profil</label><br>

            {{-- FOTO ADA? tampilkan. Kalau TIDAK ADA → tampilkan placeholder --}}
            <img src="{{ $user->profile_picture
                        ? asset('storage/' . $user->profile_picture)
                        : asset('asset-admin/img/placeholder-user.png') }}"
                 width="120" height="120"
                 class="rounded mb-2"
                 style="object-fit: cover; border: 3px solid #ddd;">

            {{-- Input Upload Baru --}}
            <input type="file" name="profile_picture" class="form-control mt-2">

            @error('profile_picture')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button class="btn btn-primary w-100">Simpan Perubahan</button>
    </form>

    {{-- Form Hapus Foto --}}
    @if ($user->profile_picture)
        <form action="{{ route('profile.destroy', $user->id) }}" method="POST" class="mt-3">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger w-100">Hapus Foto Profil</button>
        </form>
    @endif

</div>
@endsection
