@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Tambah Progres Proyek</h2>

    <form action="{{ route('progres_proyek.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row mb-2">
            <div class="col-md-3 font-weight-bold">Proyek</div>
            <div class="col-md-9">
                <select name="proyek_id" class="form-select" required>
                    <option value="">-- Pilih Proyek --</option>
                    @foreach($proyeks as $pr)
                        <option value="{{ $pr->proyek_id }}" {{ old('proyek_id') == $pr->proyek_id ? 'selected' : '' }}>
                            {{ $pr->nama_proyek }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3 font-weight-bold">Tahap</div>
            <div class="col-md-9">
                <select name="tahap_id" class="form-select" required>
                    <option value="">-- Pilih Tahap --</option>
                    @foreach($tahaps as $t)
                        <option value="{{ $t->tahap_id }}" {{ old('tahap_id') == $t->tahap_id ? 'selected' : '' }}>
                            {{ $t->nama_tahap }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3 font-weight-bold">Persen Real (%)</div>
            <div class="col-md-9">
                <input type="number" step="0.01" min="0" max="100" name="persen_real" class="form-control" value="{{ old('persen_real') }}" required>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3 font-weight-bold">Tanggal</div>
            <div class="col-md-9">
                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}" required>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3 font-weight-bold">Catatan</div>
            <div class="col-md-9">
                <textarea name="catatan" class="form-control">{{ old('catatan') }}</textarea>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3 font-weight-bold">Upload File</div>
            <div class="col-md-9">
                <input type="file" name="files[]" multiple class="form-control">
                <small class="text-muted">Bisa upload lebih dari 1 file (jpg, jpeg, png, pdf, doc, docx)</small>
            </div>
        </div>

        <div class="row mb-2 text-end">
            <div class="col-md-12">
                <a href="{{ route('progres_proyek.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </form>
</div>
@endsection
