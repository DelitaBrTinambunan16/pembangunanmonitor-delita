@extends('layouts.admin.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Tambah Progres Proyek</h2>

        <form action="{{ route('progres_proyek.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Proyek</label>
                <select name="proyek_id" class="form-select" required>
                    <option value="">-- Pilih Proyek --</option>
                    @foreach ($proyeks as $pr)
                        <option value="{{ $pr->proyek_id }}">{{ $pr->nama_proyek }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Tahap</label>
                <select name="tahap_id" class="form-select" required>
                    <option value="">-- Pilih Tahap --</option>
                    @foreach ($tahaps as $t)
                        <option value="{{ $t->tahap_id }}">{{ $t->nama_tahap }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Persen Real (%)</label>
                <input type="number" step="0.01" min="0" max="100" name="persen_real" class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Catatan</label>
                <textarea name="catatan" class="form-control"></textarea>
            </div>

            <div class="text-end">
                <a href="{{ route('progres_proyek.index') }}" class="btn btn-secondary">Kembali</a>
                <button class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
@endsection
