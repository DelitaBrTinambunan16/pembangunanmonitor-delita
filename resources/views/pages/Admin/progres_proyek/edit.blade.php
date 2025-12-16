@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Progres Proyek</h2>

    <form action="{{ route('progres_proyek.update', $item->progres_id) }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- ================= DATA UTAMA ================= --}}
        <div class="row mb-3">
            <div class="col-md-3 fw-bold">Proyek</div>
            <div class="col-md-9">
                <select name="proyek_id" class="form-select" required>
                    @foreach ($proyeks as $pr)
                        <option value="{{ $pr->proyek_id }}"
                            {{ $item->proyek_id == $pr->proyek_id ? 'selected' : '' }}>
                            {{ $pr->nama_proyek }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3 fw-bold">Tahap</div>
            <div class="col-md-9">
                <select name="tahap_id" class="form-select" required>
                    @foreach ($tahaps as $t)
                        <option value="{{ $t->tahap_id }}"
                            {{ $item->tahap_id == $t->tahap_id ? 'selected' : '' }}>
                            {{ $t->nama_tahap }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3 fw-bold">Persen Real (%)</div>
            <div class="col-md-9">
                <input type="number" step="0.01" min="0" max="100"
                       name="persen_real" class="form-control"
                       value="{{ $item->persen_real }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3 fw-bold">Tanggal</div>
            <div class="col-md-9">
                <input type="date" name="tanggal"
                       class="form-control"
                       value="{{ $item->tanggal }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3 fw-bold">Catatan</div>
            <div class="col-md-9">
                <textarea name="catatan"
                          class="form-control"
                          rows="3">{{ $item->catatan }}</textarea>
            </div>
        </div>

        {{-- ================= UPLOAD FILE BARU ================= --}}
        <div class="row mb-3">
            <div class="col-md-3 fw-bold">Upload File</div>
            <div class="col-md-9">
                <input type="file" name="files[]" multiple class="form-control">
                <small class="text-muted">
                    Bisa upload lebih dari 1 file (jpg, jpeg, png, pdf, doc, docx)
                </small>
            </div>
        </div>

        {{-- ================= FILE SAAT INI ================= --}}
        <h5 class="fw-bold mt-4 mb-2">Dokumentasi Progres</h5>

        @php
            $files = \App\Models\Media::where('ref_table', 'progres_proyek')
                ->where('ref_id', $item->progres_id)
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
                            <button type="submit"
                                    class="btn btn-danger btn-sm w-100 mt-1">
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
                    Belum ada dokumen Progres Proyek
                </div>
            </div>
        </div>
    @endif

        {{-- ================= AKSI ================= --}}
        <div class="row mb-3 text-end mt-4">
            <div class="col-md-12">
                <a href="{{ route('progres_proyek.index') }}"
                   class="btn btn-secondary">Kembali</a>
                <button type="submit"
                        class="btn btn-success">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection
