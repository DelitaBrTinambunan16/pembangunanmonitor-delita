@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Tambah Data Proyek</h2>

    <form action="{{ route('proyek.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Info Proyek --}}
        <div class="mb-3">
            <label>Kode Proyek</label>
            <input type="text" name="kode_proyek" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama Proyek</label>
            <input type="text" name="nama_proyek" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tahun</label>
            <input type="number" name="tahun" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Anggaran (Rp)</label>
            <input type="number" step="0.01" name="anggaran" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Sumber Dana</label>
            <input type="text" name="sumber_dana" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4"></textarea>
        </div>

        {{-- Upload File Pendukung --}}
        <div class="mb-3">
            <label>Upload File</label>
            <input type="file" name="files[]" class="form-control" multiple>
            <small class="text-muted">Bisa Upload lebih dari satu file (jpg, png, pdf, doc, xlsx)</small>
        </div>

        <div class="text-end">
            <a href="{{ route('proyek.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </form>
</div>
@endsection
