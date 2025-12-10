@extends('layouts.admin.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Edit Lokasi Proyek</h2>

        <form action="{{ route('lokasi.update', $item->lokasi_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Proyek</div>
                    <div class="col-md-9">
                        <select name="proyek_id" class="form-control" required>
                            <option value=""> Pilih Proyek </option>
                            @foreach ($proyeks as $proyek)
                                <option value="{{ $proyek->proyek_id }}"
                                    {{ $item->proyek_id == $proyek->proyek_id ? 'selected' : '' }}>{{ $proyek->nama_proyek }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Latitude</div>
                    <div class="col-md-9">
                        <input type="text" name="lat" class="form-control" value="{{ $item->lat }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Longitude</div>
                    <div class="col-md-9">
                        <input type="text" name="lng" class="form-control" value="{{ $item->lng }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">GeoJSON</div>
                    <div class="col-md-9">
                        <textarea name="geojson" class="form-control">{{ $item->geojson }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Upload File Baru</div>
                    <div class="col-md-9">
                        <input type="file" name="files[]" multiple class="form-control">
                        <small class="text-muted">Bisa upload banyak file sekaligus</small>
                    </div>
                </div>
            </div>

            <!-- File yang sudah ada -->
            <div class="mb-4">
                <h5 class="mb-3">Media Lokasi Proyek</h5>
                @if (!empty($item->files))
                    <div class="row">
                        @foreach ($item->files as $file)
                            <div class="col-md-3 mb-3 text-center">
                                @php $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION)) @endphp

                                @if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp']))
                                    <img src="{{ asset('storage/uploads/lokasi/' . $file) }}" class="img-fluid rounded mb-1">
                                @else
                                    <a href="{{ asset('storage/uploads/lokasi/' . $file) }}" target="_blank">
                                        <i class="bi bi-file-earmark-text" style="font-size: 2rem;"></i>
                                        <p class="mb-0">{{ $file }}</p>
                                    </a>
                                @endif

                                <form action="{{ route('lokasi.destroyFile', [$item->lokasi_id, $file]) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger mt-1"
                                        onclick="return confirm('Yakin ingin hapus file ini?')">Hapus</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Belum ada file untuk lokasi ini.</p>
                @endif
            </div>

            <div class="text-end">
                <a href="{{ route('lokasi.index') }}" class="btn btn-secondary me-2">Kembali</a>
                <button type="submit" class="btn btn-success">Update</button>
            </div>

        </form>
    </div>
@endsection
