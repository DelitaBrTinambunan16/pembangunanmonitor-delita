@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Detail Lokasi Proyek</h2>

    <div class="mb-4">
        <div class="row mb-2">
            <div class="col-md-3 font-weight-bold">Proyek</div>
            <div class="col-md-9">: {{ $item->proyek->nama_proyek ?? '-' }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 font-weight-bold">Latitude</div>
            <div class="col-md-9">: {{ $item->lat ?? '-' }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 font-weight-bold">Longitude</div>
            <div class="col-md-9">: {{ $item->lng ?? '-' }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 font-weight-bold">GeoJSON</div>
            <div class="col-md-9">: <pre>{{ $item->geojson ?? '-' }}</pre></div>
        </div>

        <div class="mt-4 text-end">
            <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('lokasi.edit', $item->lokasi_id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>

    <!-- Media Lokasi -->
    <div>
        <h5 class="mb-3">Dokumen / File</h5>
        @if(!empty($item->files))
            <div class="row">
                @foreach($item->files as $file)
                    <div class="col-md-3 mb-3 text-center">
                        @php
                            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        @endphp

                        @if(in_array($ext, ['jpg','jpeg','png','webp']))
                            <img src="{{ asset('storage/uploads/lokasi/'.$file) }}" class="img-fluid rounded mb-1">
                        @else
                            <a href="{{ asset('storage/uploads/lokasi/'.$file) }}" target="_blank">
                                <i class="bi bi-file-earmark-text" style="font-size: 2rem;"></i>
                                <p class="mb-0">{{ $file }}</p>
                            </a>
                        @endif

                        <form action="{{ route('lokasi.destroyFile', [$item->lokasi_id, $file]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger mt-1" onclick="return confirm('Yakin ingin hapus file ini?')">Hapus</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted">Belum ada file untuk lokasi ini.</p>
        @endif
    </div>
</div>
@endsection
