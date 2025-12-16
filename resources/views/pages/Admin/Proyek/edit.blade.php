@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Data Proyek</h2>

    <form action="{{ route('proyek.update', $proyek->proyek_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- ================= INFO PROYEK ================= --}}
        <div class="mb-3">
            <label>Kode Proyek</label>
            <input type="text" name="kode_proyek" class="form-control"
                   value="{{ $proyek->kode_proyek }}" required>
        </div>

        <div class="mb-3">
            <label>Nama Proyek</label>
            <input type="text" name="nama_proyek" class="form-control"
                   value="{{ $proyek->nama_proyek }}" required>
        </div>

        <div class="mb-3">
            <label>Tahun</label>
            <input type="number" name="tahun" class="form-control"
                   value="{{ $proyek->tahun }}" required>
        </div>

        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control"
                   value="{{ $proyek->lokasi }}" required>
        </div>

        <div class="mb-3">
            <label>Anggaran (Rp)</label>
            <input type="number" step="0.01" name="anggaran" class="form-control"
                   value="{{ $proyek->anggaran }}" required>
        </div>

        <div class="mb-3">
            <label>Sumber Dana</label>
            <input type="text" name="sumber_dana" class="form-control"
                   value="{{ $proyek->sumber_dana }}" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4">{{ $proyek->deskripsi }}</textarea>
        </div>

        {{-- ================= UPLOAD FILE BARU ================= --}}
        <div class="mb-3">
            <label>Upload File Pendukung</label>
            <input type="file" name="files[]" class="form-control" multiple>
            <input type="hidden" name="ref_table" value="proyek">
            <input type="hidden" name="ref_id" value="{{ $proyek->proyek_id }}">
            <small class="text-muted">Boleh upload gambar / dokumen (PDF, DOC, dll)</small>
        </div>

        {{-- ================= FILE SAAT INI ================= --}}
        <h5 class="fw-bold mt-4 mb-2">Dokumen Proyek</h5>

        @php
            $files = \App\Models\Media::where('ref_table', 'proyek')
                ->where('ref_id', $proyek->proyek_id)
                ->orderBy('sort_order')
                ->get();
        @endphp

        @if ($files->count())
            <div class="row">
                @foreach ($files as $file)
                    @php
                        $isImage = Str::startsWith($file->mime_type, 'image');
                        $fileUrl = asset($file->file_url);
                    @endphp

                    <div class="col-md-3 mb-3 text-center">
                        @if ($isImage)
                            <img src="{{ $fileUrl }}"
                                 class="img-fluid border rounded mb-2"
                                 style="max-height:140px; object-fit:cover;">
                        @else
                            <a href="{{ $fileUrl }}" target="_blank"
                               class="d-block p-2 border rounded">
                                <i class="bi bi-file-earmark-text fs-1"></i>
                                <p class="small mb-0">
                                    {{ $file->caption ?? 'Lihat File' }}
                                </p>
                            </a>
                        @endif

                        <form action="{{ route('media.destroy', $file->media_id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin hapus file ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm w-100 mt-1">
                                Hapus
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
  @else
        {{-- PLACEHOLDER  --}}
        <div class="d-flex justify-content-center">
            <div class="text-center opacity-75">
                <img src="{{ asset('asset-admin/img/default-avatar.png') }}"
                     width="80" class="mb-2">
                <div class="text-muted small">
                    Belum ada dokumen Proyek
                </div>
            </div>
        </div>
    @endif

        {{-- ================= AKSI ================= --}}
        <div class="text-end mt-4">
            <a href="{{ route('proyek.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Update</button>
        </div>

    </form>
</div>
@endsection
