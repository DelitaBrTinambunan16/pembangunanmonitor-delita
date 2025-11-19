@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Tahapan Proyek</h2>

    <div class="card p-4">
        <form action="{{ route('tahapan.update', $tahapan->tahap_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Proyek</label>
                <select name="proyek_id" class="form-control" required>
                    @foreach($proyek as $p)
                        <option value="{{ $p->proyek_id }}"
                            @if($p->proyek_id == $tahapan->proyek_id) selected @endif>
                            {{ $p->nama_proyek }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Nama Tahap</label>
                <select name="nama_tahap" class="form-control" required>
                    <option value="Diajukan" {{ $tahapan->nama_tahap == 'Diajukan' ? 'selected' : '' }}>Diajukan</option>
                    <option value="Proses" {{ $tahapan->nama_tahap == 'Proses' ? 'selected' : '' }}>Proses</option>
                    <option value="Revisi" {{ $tahapan->nama_tahap == 'Revisi' ? 'selected' : '' }}>Revisi</option>
                    <option value="Selesai" {{ $tahapan->nama_tahap == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Target (%)</label>
                <input type="number" name="target_persen" class="form-control" value="{{ $tahapan->target_persen }}" required>
            </div>

            <div class="mb-3">
                <label>Tanggal Mulai</label>
                <input type="date" name="tgl_mulai" class="form-control" value="{{ $tahapan->tgl_mulai }}" required>
            </div>

            <div class="mb-3">
                <label>Tanggal Selesai</label>
                <input type="date" name="tgl_selesai" class="form-control" value="{{ $tahapan->tgl_selesai }}" required>
            </div>

            <div class="text-end">
                <a href="{{ route('tahapan.index') }}" class="btn btn-secondary">Kembali</a>
                <button class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
