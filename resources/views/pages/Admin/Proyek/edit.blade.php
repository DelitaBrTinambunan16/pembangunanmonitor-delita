@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Data Proyek</h2>

    <form action="{{ route('proyek.update', $proyek->proyek_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Info Proyek --}}
        <div class="mb-3">
            <label>Kode Proyek</label>
            <input type="text" name="kode_proyek" class="form-control" value="{{ $proyek->kode_proyek }}" required>
        </div>
        <div class="mb-3">
            <label>Nama Proyek</label>
            <input type="text" name="nama_proyek" class="form-control" value="{{ $proyek->nama_proyek }}" required>
        </div>
        <div class="mb-3">
            <label>Tahun</label>
            <input type="number" name="tahun" class="form-control" value="{{ $proyek->tahun }}" required>
        </div>
        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control" value="{{ $proyek->lokasi }}" required>
        </div>
        <div class="mb-3">
            <label>Anggaran (Rp)</label>
            <input type="number" step="0.01" name="anggaran" class="form-control" value="{{ $proyek->anggaran }}" required>
        </div>
        <div class="mb-3">
            <label>Sumber Dana</label>
            <input type="text" name="sumber_dana" class="form-control" value="{{ $proyek->sumber_dana }}" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4">{{ $proyek->deskripsi }}</textarea>
        </div>

        {{-- Upload File Pendukung Baru --}}
        <div class="mb-3">
            <label>Upload File</label>
            <input type="file" name="files[]" class="form-control" multiple>
            <input type="hidden" name="ref_table" value="proyek">
            <input type="hidden" name="ref_id" value="{{ $proyek->proyek_id }}">
        </div>

        {{-- File yang sudah ada --}}
        <div class="mb-3">
            <label>File Pendukung Saat Ini:</label><br>
            @php
                $files = DB::table('media')
                    ->where('ref_table', 'proyek')
                    ->where('ref_id', $proyek->proyek_id)
                    ->get();
            @endphp

            @foreach ($files as $file)
                @php $ext = pathinfo($file->file_url, PATHINFO_EXTENSION); @endphp
                <div class="mb-2 d-flex align-items-center gap-2">
                    @if(in_array(strtolower($ext), ['jpg','jpeg','png','gif']))
                        <img src="{{ asset('uploads/' . $file->file_url) }}" width="100" class="img-thumbnail">
                    @else
                        <span>{{ $file->file_url

                        }}</span>
                    @endif

                    <form action="{{ route('media.destroy', $file->media_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus file ini?')">Hapus</button>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="text-end">
            <a href="{{ route('proyek.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </form>
</div>
@endsection
