@extends('layouts.admin.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Edit Kontraktor</h2>

    <form action="{{ route('kontraktor.update', $item->kontraktor_id) }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- DATA KONTRAKTOR --}}
        <div class="mb-3">
            <label>Proyek</label>
            <select name="proyek_id" class="form-select" required>
                @foreach ($proyeks as $pr)
                    <option value="{{ $pr->proyek_id }}"
                        {{ $item->proyek_id == $pr->proyek_id ? 'selected' : '' }}>
                        {{ $pr->nama_proyek }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control"
                   value="{{ $item->nama }}" required>
        </div>

        <div class="mb-3">
            <label>Penanggung Jawab</label>
            <input type="text" name="penanggung_jawab"
                   class="form-control"
                   value="{{ $item->penanggung_jawab }}">
        </div>

        <div class="mb-3">
            <label>Kontak</label>
            <input type="text" name="kontak"
                   class="form-control"
                   value="{{ $item->kontak }}">
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat"
                      class="form-control">{{ $item->alamat }}</textarea>
        </div>

        {{-- UPLOAD FILE BARU --}}
        <div class="mb-4">
            <label class="fw-bold">Upload Dokumen Baru</label>
            <input type="file" name="files[]" class="form-control" multiple>
            <small class="text-muted">Gambar / PDF / Dokumen lain</small>
        </div>

        {{-- ================= DOKUMEN / PLACEHOLDER ================= --}}
        <h5 class="mb-3">Dokumen Kontraktor</h5>

        @if($item->media && $item->media->count())
            <div class="row">
                @foreach($item->media as $media)
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
                              method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm w-100"
                                    onclick="return confirm('Hapus file ini?')">
                                Hapus
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            {{-- PLACEHOLDER --}}
            <div class="d-flex justify-content-center">
                <div class="text-center opacity-75">
                    <img src="{{ asset('asset-admin/img/default-avatar.png') }}"
                         width="80" class="mb-2">
                    <div class="text-muted small">
                        Belum ada dokumen kontraktor
                    </div>
                </div>
            </div>
        @endif

        {{-- AKSI --}}
        <div class="text-end mt-4">
            <a href="{{ route('kontraktor.index') }}" class="btn btn-secondary">
                Kembali
            </a>
            <button class="btn btn-success">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
