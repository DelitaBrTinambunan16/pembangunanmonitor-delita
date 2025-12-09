@extends('layouts.admin.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Detail Kontraktor</h2>

        <table class="table">
            <tr>
                <th>Nama</th>
                <td>{{ $item->nama }}</td>
            </tr>
            <tr>
                <th>Penanggung Jawab</th>
                <td>{{ $item->penanggung_jawab }}</td>
            </tr>
            <tr>
                <th>Kontak</th>
                <td>{{ $item->kontak }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $item->alamat }}</td>
            </tr>
            <tr>
                <th>Proyek</th>
                <td>{{ $item->proyek->nama_proyek ?? '-' }}</td>
            </tr>
        </table>

        <a href="{{ route('kontraktor.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
