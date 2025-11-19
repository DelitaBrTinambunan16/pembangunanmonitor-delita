@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Detail Tahapan Proyek</h2>

    <div class="card p-4">
        <p><strong>Proyek:</strong> {{ $tahapan->proyek->nama_proyek }}</p>
        <p><strong>Nama Tahap:</strong> {{ $tahapan->nama_tahap }}</p>
        <p><strong>Target (%):</strong> {{ $tahapan->target_persen }}</p>
        <p><strong>Tanggal Mulai:</strong> {{ $tahapan->tgl_mulai }}</p>
        <p><strong>Tanggal Selesai:</strong> {{ $tahapan->tgl_selesai }}</p>

        <div class="text-end">
            <a href="{{ route('tahapan.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('tahapan.edit', $tahapan->tahap_id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection
