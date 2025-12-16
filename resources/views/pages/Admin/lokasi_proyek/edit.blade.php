@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Lokasi Proyek</h2>

    <form action="{{ route('lokasi.update', $item->lokasi_id) }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- PROYEK --}}
        <div class="mb-3">
            <label class="fw-bold">Proyek</label>
            <select name="proyek_id" class="form-select" required>
                @foreach ($proyekList as $p)
                    <option value="{{ $p->proyek_id }}"
                        {{ $item->proyek_id == $p->proyek_id ? 'selected' : '' }}>
                        {{ $p->nama_proyek }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- LAT / LNG / GEOJSON --}}
        <div class="mb-3">
            <label class="fw-bold">Latitude</label>
            <input type="text" name="lat" class="form-control" value="{{ $item->lat }}">
        </div>

        <div class="mb-3">
            <label class="fw-bold">Longitude</label>
            <input type="text" name="lng" class="form-control" value="{{ $item->lng }}">
        </div>

        <div class="mb-3">
            <label class="fw-bold">GeoJSON</label>
            <textarea name="geojson" class="form-control">{{ $item->geojson }}</textarea>
        </div>

        {{-- UPLOAD --}}
        <div class="mb-4">
            <label class="fw-bold">Upload Dokumen Baru</label>
            <input type="file" name="files[]" multiple class="form-control">
        </div>

        {{-- ================= MEDIA / PLACEHOLDER ================= --}}
        <h5 class="mb-3">Dokumen Lokasi Proyek</h5>

        @if($item->media && $item->media->count())
            <div class="row">
                @foreach($item->media as $media)
                    @php
                        $isImage = Str::startsWith($media->mime_type,'image');
                        $path = asset('storage/uploads/lokasi_proyek/'.$media->file_url);
                    @endphp

                    <div class="col-md-3 mb-3 text-center">
                        @if($isImage)
                            <img src="{{ $path }}"
                                 class="img-fluid rounded mb-2"
                                 style="max-height:150px;object-fit:cover;width:100%">
                        @else
                            <a href="{{ $path }}" target="_blank">
                                <i class="bi bi-file-earmark-text fs-1"></i>
                                <p class="small text-truncate">{{ $media->file_url }}</p>
                            </a>
                        @endif

                        <form action="{{ route('media.destroy',$media->media_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm w-100"
                                    onclick="return confirm('Hapus file ini?')">
                                Hapus
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            {{-- PLACEHOLDER (SAMA DENGAN SHOW) --}}
            <div class="d-flex justify-content-center">
                <div class="text-center opacity-75">
                    <img src="{{ asset('asset-admin/img/default-avatar.png') }}"
                         width="80" class="mb-2">
                    <div class="text-muted small">
                        Belum ada dokumen lokasi
                    </div>
                </div>
            </div>
        @endif

        {{-- BUTTON --}}
        <div class="text-end mt-4">
            <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">Kembali</a>
            <button class="btn btn-success">Update</button>
        </div>

    </form>
</div>
@endsection
