@extends('layouts.admin.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Detail Progres</h2>

        <table class="table">
            <tr>
                <th>Proyek</th>
                <td>{{ $item->proyek->nama_proyek ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tahap</th>
                <td>{{ $item->tahap->nama_tahap ?? '-' }}</td>
            </tr>
            <tr>
                <th>Persen</th>
                <td>{{ $item->persen_real }}%</td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td>{{ $item->tanggal }}</td>
            </tr>
            <tr>
                <th>Catatan</th>
                <td>{{ $item->catatan ?? '-' }}</td>
            </tr>
        </table>

        <a href="{{ route('progres_proyek.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
