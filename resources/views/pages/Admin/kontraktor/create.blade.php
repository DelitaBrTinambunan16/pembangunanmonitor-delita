@extends('layouts.admin.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Tambah Kontraktor</h2>

        <form action="{{ route('kontraktor.store') }}" method="POST">
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
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Penanggung Jawab</label>
                <input type="text" name="penanggung_jawab" class="form-control">
            </div>

            <div class="mb-3">
                <label>Kontak</label>
                <input type="text" name="kontak" class="form-control">
            </div>

            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control"></textarea>
            </div>

            <div class="text-end">
                <a href="{{ route('kontraktor.index') }}" class="btn btn-secondary">Kembali</a>
                <button class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
@endsection
