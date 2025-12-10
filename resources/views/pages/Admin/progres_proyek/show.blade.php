@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Detail Progres Proyek</h2>

    <div class="mb-4">
        <!-- Detail Progres -->
        <div class="row mb-2">
            <div class="col-md-3 font-weight-bold">Proyek</div>
            <div class="col-md-9">: {{ $item->proyek->nama_proyek ?? '-' }}</div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3 font-weight-bold">Tahap</div>
            <div class="col-md-9">: {{ $item->tahap->nama_tahap ?? '-' }}</div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3 font-weight-bold">Persen Real (%)</div>
            <div class="col-md-9">: {{ $item->persen_real ?? 0 }}%</div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3 font-weight-bold">Tanggal</div>
            <div class="col-md-9">: {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d M Y') : '-' }}</div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3 font-weight-bold">Catatan</div>
            <div class="col-md-9">: {{ $item->catatan ?? '-' }}</div>
        </div>

        <div class="mt-4 text-end">
            <a href="{{ route('progres_proyek.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('progres_proyek.edit', $item->progres_id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>

    <!-- Media Progres -->
    <div>
        <h5 class="mb-3">Dokumen / Media Progres</h5>
        @if($item->media->count() > 0)
            <div class="row">
                @foreach($item->media as $media)
                    <div class="col-6 col-md-3 mb-3 text-center">
                        @php
                            $extension = strtolower(pathinfo($media->file_url, PATHINFO_EXTENSION));
                        @endphp

                        @if(in_array($extension, ['jpg','jpeg','png','webp']))
                            <img src="{{ asset('storage/uploads/progres_proyek/' . $media->file_url) }}"
                                 class="img-fluid rounded mb-1"
                                 alt="{{ $media->caption ?? '' }}">
                        @else
                            <a href="{{ asset('storage/uploads/progres_proyek/' . $media->file_url) }}" target="_blank">
                                <i class="bi bi-file-earmark-text" style="font-size: 2rem;"></i>
                                <p class="mb-0 text-truncate" style="max-width: 100%;">{{ $media->file_url }}</p>
                            </a>
                        @endif

                        @if($media->caption)
                            <small>{{ $media->caption }}</small>
                        @endif

                        <form action="{{ route('media.destroy', $media->media_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger mt-1" onclick="return confirm('Yakin ingin hapus file ini?')">Hapus</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted">Belum ada media untuk progres ini.</p>
        @endif
    </div>
</div>
@endsection
