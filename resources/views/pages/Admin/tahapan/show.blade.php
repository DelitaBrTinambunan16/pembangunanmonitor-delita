@extends('layouts.admin.app')

@section('content')
    <div class="container mt-4">

        <h4 class="mb-4 text-center fw-bold">Detail Tahapan Proyek</h4>

        <div class="row g-3 mb-4">
            <div class="col-md-6"><strong>Proyek</strong><br>{{ $tahapan->proyek->nama_proyek }}</div>
            <div class="col-md-6"><strong>Nama Tahap</strong><br>{{ $tahapan->nama_tahap }}</div>
            <div class="col-md-6"><strong>Target</strong><br>{{ $tahapan->target_persen }}%</div>
            <div class="col-md-6"><strong>Mulai</strong><br>{{ \Carbon\Carbon::parse($tahapan->tgl_mulai)->format('d M Y') }}
            </div>
            <div class="col-md-6">
                <strong>Selesai</strong><br>{{ \Carbon\Carbon::parse($tahapan->tgl_selesai)->format('d M Y') }}</div>
        </div>

        <h6 class="mb-3">Dokumen Tahapan</h6>

        @if ($tahapan->media->count())
            <div class="row">
                @foreach ($tahapan->media as $media)
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
            <div class="d-flex justify-content-center py-4">
                <div class="text-center opacity-75">
                    <img src="{{ asset('asset-admin/img/default-avatar.png') }}" width="80">
                    <div class="text-muted small">Belum ada dokumen tahapan</div>
                </div>
            </div>
        @endif

        <a href="{{ route('tahapan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
@endsection
