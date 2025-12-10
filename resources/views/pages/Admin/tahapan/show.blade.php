@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Detail Tahapan Proyek</h2>

    <div class="mb-4">
        <div class="row mb-2">
            <div class="col-md-3 font-weight-bold">Proyek</div>
            <div class="col-md-9">: {{ $tahapan->proyek->nama_proyek }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 font-weight-bold">Nama Tahap</div>
            <div class="col-md-9">: {{ $tahapan->nama_tahap }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 font-weight-bold">Target (%)</div>
            <div class="col-md-9">: {{ $tahapan->target_persen }}%</div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 font-weight-bold">Tanggal Mulai</div>
            <div class="col-md-9">: {{ \Carbon\Carbon::parse($tahapan->tgl_mulai)->format('d M Y') }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 font-weight-bold">Tanggal Selesai</div>
            <div class="col-md-9">: {{ \Carbon\Carbon::parse($tahapan->tgl_selesai)->format('d M Y') }}</div>
        </div>

        <div class="mt-4 text-end">
            <a href="{{ route('tahapan.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('tahapan.edit', $tahapan->tahap_id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>

    <!-- Media Tahapan -->
    <div>
        <h5 class="mb-3">Dokumen Tahapan</h5>
        @if($tahapan->media->count() > 0)
            <div class="row">
                @foreach($tahapan->media as $media)
                    <div class="col-md-3 mb-3 text-center">
                        @if(in_array(pathinfo($media->file_url, PATHINFO_EXTENSION), ['jpg','jpeg','png','webp']))
                            <img src="{{ asset('storage/uploads/' . $media->ref_table . '/' . $media->file_url) }}" class="img-fluid rounded mb-1">
                        @else
                            <a href="{{ asset('storage/uploads/' . $media->ref_table . '/' . $media->file_url) }}" target="_blank">
                                <i class="bi bi-file-earmark-text" style="font-size: 2rem;"></i>
                                <p class="mb-0">{{ $media->file_url }}</p>
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
            <p class="text-muted">Belum ada media untuk tahapan ini.</p>
        @endif
    </div>
</div>
@endsection
