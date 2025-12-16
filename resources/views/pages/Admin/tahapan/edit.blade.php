@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Tahapan Proyek</h2>

    <form action="{{ route('tahapan.update', $tahapan->tahap_id) }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="fw-bold">Proyek</label>
            <select name="proyek_id" class="form-select" required>
                @foreach ($proyek as $p)
                    <option value="{{ $p->proyek_id }}"
                        {{ old('proyek_id', $tahapan->proyek_id) == $p->proyek_id ? 'selected' : '' }}>
                        {{ $p->nama_proyek }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Nama Tahap</label>
            <select name="nama_tahap" class="form-select" required>
                @foreach ($pilihanTahap as $item)
                    <option value="{{ $item }}"
                        {{ old('nama_tahap', $tahapan->nama_tahap) == $item ? 'selected' : '' }}>
                        {{ $item }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Target (%)</label>
            <input type="number" name="target_persen" class="form-control"
                   value="{{ old('target_persen', $tahapan->target_persen) }}" required>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Tanggal Mulai</label>
            <input type="date" name="tgl_mulai" class="form-control"
                   value="{{ old('tgl_mulai', $tahapan->tgl_mulai) }}" required>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Tanggal Selesai</label>
            <input type="date" name="tgl_selesai" class="form-control"
                   value="{{ old('tgl_selesai', $tahapan->tgl_selesai) }}" required>
        </div>

        {{-- UPLOAD FILE --}}
        <div class="mb-4">
            <label class="fw-bold">Upload Dokumen Baru</label>
            <input type="file" name="files[]" multiple class="form-control">
        </div>

        {{-- ================= DOKUMEN TAHAPAN ================= --}}
        <h5 class="mb-3">Dokumen Tahapan</h5>

        @if($tahapan->media->count())
            <div class="row">
                @foreach($tahapan->media as $media)
                    @php
                        $isImage = Str::startsWith($media->mime_type,'image');
                        $path = asset('storage/uploads/'.$media->ref_table.'/'.$media->file_url);
                    @endphp

                    <div class="col-md-3 text-center mb-3">
                        @if($isImage)
                            <img src="{{ $path }}"
                                 class="img-fluid rounded mb-2"
                                 style="max-height:120px;object-fit:cover;width:100%">
                        @else
                            <a href="{{ $path }}" target="_blank">
                                <i class="bi bi-file-earmark-text fs-1"></i>
                                <p class="small text-truncate">{{ $media->file_url }}</p>
                            </a>
                        @endif

                        <form action="{{ route('media.destroy',$media->media_id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin hapus file ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm w-100">
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
                    Belum ada dokumen tahapan
                </div>
            </div>
        </div>
    @endif

        <div class="text-end mt-4">
            <a href="{{ route('tahapan.index') }}" class="btn btn-secondary">Kembali</a>
            <button class="btn btn-success">Perbarui</button>
        </div>
    </form>
</div>
@endsection
