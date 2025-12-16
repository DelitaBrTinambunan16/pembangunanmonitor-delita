@extends('layouts.admin.app')

@section('content')
    <div class="container mt-4">

        <h4 class="mb-4 text-center fw-bold">Detail Lokasi Proyek</h4>

        <div class="row g-3 mb-4">
            <div class="col-md-6"><strong>Proyek</strong><br>{{ $item->proyek->nama_proyek ?? '-' }}</div>
            <div class="col-md-6"><strong>Latitude</strong><br>{{ $item->lat ?? '-' }}</div>
            <div class="col-md-6"><strong>Longitude</strong><br>{{ $item->lng ?? '-' }}</div>
            <div class="col-md-12"><strong>GeoJSON</strong>
                <pre>{{ $item->geojson ?? '-' }}</pre>
            </div>
        </div>

        <h6 class="mb-3">Dokumen Lokasi Proyek</h6>

        @if ($item->media && $item->media->count())
            <div class="row">
                @foreach ($item->media as $media)
                    @php
                        $isImage = Str::startsWith($media->mime_type, 'image');
                        $path = asset('storage/uploads/lokasi_proyek/' . $media->file_url);
                    @endphp
                    <div class="col-6 col-md-3 mb-3 text-center">
                        @if ($isImage)
                            <img src="{{ $path }}" class="img-fluid rounded">
                        @else
                            <a href="{{ $path }}" target="_blank">
                                <i class="bi bi-file-earmark-text fs-1"></i>
                                <div class="small text-truncate">{{ $media->file_url }}</div>
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="d-flex justify-content-center py-4">
                <div class="text-center opacity-75">
                    <img src="{{ asset('asset-admin/img/default-avatar.png') }}" width="80">
                    <div class="text-muted small">Belum ada dokumen lokasi</div>
                </div>
            </div>
        @endif

        <a href="{{ route('lokasi.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
@endsection
