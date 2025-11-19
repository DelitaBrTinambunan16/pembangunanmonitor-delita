@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Tambah Tahapan Proyek</h2>

    <div class="card p-4">
        <form action="{{ route('tahapan.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Proyek</label>
                <select name="proyek_id" class="form-control" required>
                    <option value="">-- Pilih Proyek --</option>
                    @foreach($proyek as $p)
                        <option value="{{ $p->proyek_id }}">{{ $p->nama_proyek }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Nama Tahap</label>
                <select name="nama_tahap" class="form-control" required>
                    <option value="">-- Pilih Tahapan --</option>
                    <option value="Diajukan">Diajukan</option>
                    <option value="Proses">Proses</option>
                    <option value="Revisi">Revisi</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Target (%)</label>
                <input type="number" name="target_persen" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Tanggal Mulai</label>
                <input type="date" name="tgl_mulai" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Tanggal Selesai</label>
                <input type="date" name="tgl_selesai" class="form-control" required>
            </div>

            <div class="text-end">
                <a href="{{ route('tahapan.index') }}" class="btn btn-secondary">Kembali</a>
                <button class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
