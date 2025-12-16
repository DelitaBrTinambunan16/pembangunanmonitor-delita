@extends('layouts.admin.app')

@section('content')
    <div class="container mt-4">

        <h4 class="mb-4 text-center fw-bold">Detail Kontraktor</h4>

        {{-- INFORMASI --}}
        <div class="row g-3 mb-4">
            <div class="col-md-6"><strong>Nama</strong><br>{{ $item->nama }}</div>
            <div class="col-md-6"><strong>Penanggung Jawab</strong><br>{{ $item->penanggung_jawab }}</div>
            <div class="col-md-6"><strong>Kontak</strong><br>{{ $item->kontak }}</div>
            <div class="col-md-6"><strong>Alamat</strong><br>{{ $item->alamat }}</div>
            <div class="col-md-6"><strong>Proyek</strong><br>{{ $item->proyek->nama_proyek ?? '-' }}</div>
        </div>

        <h6 class="mb-3">Dokumen Kontraktor</h6>

        @if ($item->media && $item->media->count())
            <div class="row">
                @foreach ($item->media as $media)
                    @php
                        $isImage = Str::startsWith($media->mime_type, 'image');
                        $path = asset('storage/uploads/' . $media->ref_table . '/' . $media->file_url);
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
            {{-- PLACEHOLDER --}}
            <div class="d-flex justify-content-center py-4">
                <div class="text-center opacity-75">
                    <img src="{{ asset('asset-admin/img/default-avatar.png') }}" width="80">
                    <div class="text-muted small">Belum ada dokumen kontraktor</div>
                </div>
            </div>
        @endif

        <a href="{{ route('kontraktor.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
@endsection
