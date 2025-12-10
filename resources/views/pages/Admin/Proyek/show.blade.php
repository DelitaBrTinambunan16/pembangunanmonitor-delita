@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Detail Proyek</h2>

    <div class="mb-3">
        <a href="{{ route('proyek.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>Kode Proyek</th>
            <td>{{ $proyek->kode_proyek }}</td>
        </tr>
        <tr>
            <th>Nama Proyek</th>
            <td>{{ $proyek->nama_proyek }}</td>
        </tr>
        <tr>
            <th>Tahun</th>
            <td>{{ $proyek->tahun }}</td>
        </tr>
        <tr>
            <th>Lokasi</th>
            <td>{{ $proyek->lokasi }}</td>
        </tr>
        <tr>
            <th>Anggaran</th>
            <td>Rp {{ number_format($proyek->anggaran, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Sumber Dana</th>
            <td>{{ $proyek->sumber_dana }}</td>
        </tr>
        <tr>
            <th>Deskripsi</th>
            <td>{{ $proyek->deskripsi }}</td>
        </tr>
    </table>

    <h4 class="mt-4">Dokumen Proyek</h4>
    <div class="row">
        @foreach ($media as $item)
            <div class="col-md-3 mb-3">
                <div class="card">
                    @if (Str::startsWith($item->mime_type, 'image'))
                        <img src="{{ asset($item->file_url) }}" class="card-img-top" alt="{{ $item->caption }}">
                    @else
                        <div class="card-body">
                            <a href="{{ asset($item->file_url) }}" target="_blank">{{ $item->caption ?? 'Lihat File' }}</a>
                        </div>
                    @endif
                    @if($item->caption)
                        <div class="card-footer text-center">{{ $item->caption }}</div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
