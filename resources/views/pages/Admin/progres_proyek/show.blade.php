@extends('layouts.admin.app')

@section('content')
    <div class="container mt-4">

        <h4 class="mb-4 text-center fw-bold">Detail Progres Proyek</h4>

        <div class="row g-3 mb-4">
            <div class="col-md-6"><strong>Proyek</strong><br>{{ $item->proyek->nama_proyek ?? '-' }}</div>
            <div class="col-md-6"><strong>Tahap</strong><br>{{ $item->tahapan->nama_tahap ?? '-' }}</div>
            <div class="col-md-6"><strong>Realisasi</strong><br>{{ $item->persen_real }}%</div>
            <div class="col-md-6">
                <strong>Tanggal</strong><br>{{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d M Y') : '-' }}
            </div>
            <div class="col-md-12"><strong>Catatan</strong><br>{{ $item->catatan ?? '-' }}</div>
        </div>

        <h6 class="mb-3">Dokumen Progres</h6>

        @php
            $mediaList = \App\Models\Media::where('ref_table', 'progres_proyek')
                ->where('ref_id', $item->progres_id)
                ->get();
        @endphp

        @if ($mediaList->count())
            <div class="row">
                @foreach ($mediaList as $media)
                    @php $isImage = Str::startsWith($media->mime_type,'image'); @endphp
                    <div class="col-6 col-md-3 mb-3 text-center">
                        @if ($isImage)
                            <img src="{{ asset($media->file_url) }}" class="img-fluid rounded">
                        @else
                            <a href="{{ asset($media->file_url) }}" target="_blank">
                                <i class="bi bi-file-earmark-text fs-1"></i>
                                <div class="small text-truncate">{{ $media->caption ?? 'File' }}</div>
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="d-flex justify-content-center py-4">
                <div class="text-center opacity-75">
                    <img src="{{ asset('asset-admin/img/default-avatar.png') }}" width="80">
                    <div class="text-muted small">Belum ada dokumen progres</div>
                </div>
            </div>
        @endif

        <a href="{{ route('progres_proyek.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
@endsection
