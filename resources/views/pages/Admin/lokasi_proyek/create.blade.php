@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Tambah Lokasi Proyek</h2>

    <form action="{{ route('lokasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Proyek</div>
                <div class="col-md-9">
                    <select name="proyek_id" class="form-control" required>
                        <option value=""> Pilih Proyek </option>
                        @foreach($proyeks as $proyek)
                            <option value="{{ $proyek->proyek_id }}" {{ old('proyek_id')==$proyek->proyek_id ? 'selected' : '' }}>{{ $proyek->nama_proyek }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Latitude</div>
                <div class="col-md-9">
                    <input type="text" name="lat" class="form-control" value="{{ old('lat') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Longitude</div>
                <div class="col-md-9">
                    <input type="text" name="lng" class="form-control" value="{{ old('lng') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">GeoJSON</div>
                <div class="col-md-9">
                    <textarea name="geojson" class="form-control">{{ old('geojson') }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Upload File</div>
                <div class="col-md-9">
                    <input type="file" name="files[]" id="files" multiple class="form-control">
                    <small class="text-muted">Bisa upload lebih dari 1 file (jpg, jpeg, png, pdf, doc, docx)</small>
                </div>
            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

<script>
document.getElementById('files').addEventListener('change', function(event){
    const preview = document.getElementById('file-preview');
    preview.innerHTML = '';

    Array.from(event.target.files).forEach(file => {
        const col = document.createElement('div');
        col.className = 'col-md-3 mb-3 text-center';

        const ext = file.name.split('.').pop().toLowerCase();

        if(['jpg','jpeg','png','webp'].includes(ext)){
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.className = 'img-fluid rounded mb-1';
            img.style.height = '100px';
            col.appendChild(img);
        } else {
            const icon = document.createElement('i');
            icon.className = 'bi bi-file-earmark-text';
            icon.style.fontSize = '2rem';
            col.appendChild(icon);

            const p = document.createElement('p');
            p.className = 'mb-0';
            p.innerText = file.name;
            col.appendChild(p);
        }

        preview.appendChild(col);
    });
});
</script>
@endsection
