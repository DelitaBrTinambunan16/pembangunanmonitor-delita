@extends('layouts.admin.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 text-center">Edit Lokasi Proyek</h2>

        <form action="{{ route('lokasi.update', $lokasi->lokasi_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Proyek</label>
                <select name="proyek_id" class="form-select" required>
                    <option value="">-- Pilih Proyek --</option>
                    @foreach ($proyekList as $proyek)
                        <option value="{{ $proyek->proyek_id }}"
                            {{ $lokasi->proyek_id == $proyek->proyek_id ? 'selected' : '' }}>
                            {{ $proyek->nama_proyek }}
                        </option>
                    @endforeach
                </select>
                @error('proyek_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Latitude (Lat)</label>
                <input type="text" name="lat" class="form-control" value="{{ $lokasi->lat }}" required>
                @error('lat')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Longitude (Lng)</label>
                <input type="text" name="lng" class="form-control" value="{{ $lokasi->lng }}" required>
                @error('lng')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>GeoJSON</label>
                <textarea name="geojson" class="form-control" rows="4" required>{{ $lokasi->geojson }}</textarea>
                @error('geojson')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="text-end">
                <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
    </div>
@endsection
