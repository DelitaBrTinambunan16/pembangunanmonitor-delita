@extends('layouts.admin.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 text-center">Detail Lokasi Proyek</h2>

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>ID Lokasi</th>
                        <td>{{ $lokasi->lokasi_id }}</td>
                    </tr>
                    <tr>
                        <th>Proyek</th>
                        <td>{{ $lokasi->proyek->nama_proyek ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Latitude (Lat)</th>
                        <td>{{ $lokasi->lat }}</td>
                    </tr>
                    <tr>
                        <th>Longitude (Lng)</th>
                        <td>{{ $lokasi->lng }}</td>
                    </tr>
                    <tr>
                        <th>GeoJSON</th>
                        <td>
                            <pre>{{ $lokasi->geojson }}</pre>
                        </td>
                    </tr>
                    <tr>
                        <th>Dibuat Pada</th>
                        <td>{{ $lokasi->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir Diperbarui</th>
                        <td>{{ $lokasi->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                </table>

                <div class="text-end mt-3">
                    <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">Kembali</a>
                    <a href="{{ route('lokasi.edit', $lokasi->lokasi_id) }}" class="btn btn-warning">Edit</a>
                </div>
            </div>
        </div>
    </div>
@endsection
