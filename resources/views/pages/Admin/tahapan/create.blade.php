@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Tambah Tahapan Proyek</h2>

    <form action="{{ route('tahapan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Proyek</label>
            <select name="proyek_id" class="form-control" required>
                <option value="">-- Pilih Proyek --</option>
                @foreach ($proyek as $p)
                    <option value="{{ $p->proyek_id }}" {{ old('proyek_id') == $p->proyek_id ? 'selected' : '' }}>
                        {{ $p->nama_proyek }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Nama Tahap</label>
            <select name="nama_tahap" class="form-select" required>
                <option value="" disabled selected>-- Pilih Tahap --</option>
                @foreach ($pilihanTahap as $item)
                    <option value="{{ $item }}" {{ old('nama_tahap') == $item ? 'selected' : '' }}>{{ $item }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Target (%)</label>
            <input type="number" name="target_persen" class="form-control" value="{{ old('target_persen') }}" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Mulai</label>
            <input type="date" name="tgl_mulai" class="form-control" value="{{ old('tgl_mulai') }}" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Selesai</label>
            <input type="date" name="tgl_selesai" class="form-control" value="{{ old('tgl_selesai') }}" required>
        </div>

        <!-- Multiple File Upload -->
        <div class="mb-3">
            <label>Upload File</label>
            <input type="file" name="files[]" class="form-control" multiple>
            <small class="text-muted">Bisa Upload lebih dari satu file (jpg, png, pdf, doc, xlsx)</small>
        </div>

        <div class="text-end">
            <a href="{{ route('tahapan.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </form>
</div>
@endsection
