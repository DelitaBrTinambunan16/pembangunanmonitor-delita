@extends('layouts.admin.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Edit Progres Proyek</h2>

        <form action="{{ route('progres_proyek.update', $item->progres_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Proyek</label>
                <select name="proyek_id" class="form-select" required>
                    @foreach ($proyeks as $pr)
                        <option value="{{ $pr->proyek_id }}" {{ $item->proyek_id == $pr->proyek_id ? 'selected' : '' }}>
                            {{ $pr->nama_proyek }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Tahap</label>
                <select name="tahap_id" class="form-select" required>
                    @foreach ($tahaps as $t)
                        <option value="{{ $t->tahap_id }}" {{ $item->tahap_id == $t->tahap_id ? 'selected' : '' }}>
                            {{ $t->nama_tahap }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Persen Real (%)</label>
                <input type="number" step="0.01" min="0" max="100" name="persen_real" class="form-control"
                    value="{{ $item->persen_real }}" required>
            </div>

            <div class="mb-3">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ $item->tanggal }}" required>
            </div>

            <div class="mb-3">
                <label>Catatan</label>
                <textarea name="catatan" class="form-control">{{ $item->catatan }}</textarea>
            </div>

            <div class="text-end">
                <a href="{{ route('progres_proyek.index') }}" class="btn btn-secondary">Kembali</a>
                <button class="btn btn-success">Update</button>
            </div>
        </form>
    </div>
@endsection
