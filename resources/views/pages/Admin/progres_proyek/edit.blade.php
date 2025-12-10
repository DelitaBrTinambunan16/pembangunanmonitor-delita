@extends('layouts.admin.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Edit Progres Proyek</h2>

        <form action="{{ route('progres_proyek.update', $item->progres_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Proyek</div>
                <div class="col-md-9">
                    <select name="proyek_id" class="form-select" required>
                        @foreach ($proyeks as $pr)
                            <option value="{{ $pr->proyek_id }}" {{ $item->proyek_id == $pr->proyek_id ? 'selected' : '' }}>
                                {{ $pr->nama_proyek }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Tahap</div>
                <div class="col-md-9">
                    <select name="tahap_id" class="form-select" required>
                        @foreach ($tahaps as $t)
                            <option value="{{ $t->tahap_id }}" {{ $item->tahap_id == $t->tahap_id ? 'selected' : '' }}>
                                {{ $t->nama_tahap }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Persen Real (%)</div>
                <div class="col-md-9">
                    <input type="number" step="0.01" min="0" max="100" name="persen_real"
                        class="form-control" value="{{ $item->persen_real }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Tanggal</div>
                <div class="col-md-9">
                    <input type="date" name="tanggal" class="form-control" value="{{ $item->tanggal }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Catatan</div>
                <div class="col-md-9">
                    <textarea name="catatan" class="form-control">{{ $item->catatan }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Upload File</div>
                <div class="col-md-9">
                    <input type="file" name="files[]" multiple class="form-control">
                    <small class="text-muted">Bisa upload lebih dari 1 file (jpg, jpeg, png, pdf, doc, docx)</small>
                </div>
            </div>

            @if ($item->media->count() > 0)
                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">File Lama</div>
                    <div class="col-md-9">
                        <ul class="list-unstyled">
                            @foreach ($item->media as $file)
                                <li class="mb-1">
                                    <a href="{{ asset('storage/uploads/progres/' . $file->file_url) }}" target="_blank">
                                        {{ $file->file_url }}
                                    </a>
                                    <form action="{{ route('media.destroy', $file->media_id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin hapus file ini?')">Hapus</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif


            <div class="row mb-3 text-end">
                <div class="col-md-12">
                    <a href="{{ route('progres_proyek.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection
