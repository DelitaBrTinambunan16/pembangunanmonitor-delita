@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Tahapan Proyek</h2>

    <form action="{{ route('tahapan.update', $tahapan->tahap_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Proyek</label>
            <select name="proyek_id" class="form-control" required>
                @foreach ($proyek as $p)
                    <option value="{{ $p->proyek_id }}" {{ old('proyek_id', $tahapan->proyek_id) == $p->proyek_id ? 'selected' : '' }}>
                        {{ $p->nama_proyek }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Nama Tahap</label>
            <select name="nama_tahap" class="form-select" required>
                <option value="" disabled>-- Pilih Tahap --</option>
                @foreach ($pilihanTahap as $item)
                    <option value="{{ $item }}" {{ old('nama_tahap', $tahapan->nama_tahap) == $item ? 'selected' : '' }}>
                        {{ $item }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Target (%)</label>
            <input type="number" name="target_persen" class="form-control" value="{{ old('target_persen', $tahapan->target_persen) }}" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Mulai</label>
            <input type="date" name="tgl_mulai" class="form-control" value="{{ old('tgl_mulai', $tahapan->tgl_mulai) }}" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Selesai</label>
            <input type="date" name="tgl_selesai" class="form-control" value="{{ old('tgl_selesai', $tahapan->tgl_selesai) }}" required>
        </div>

        <!-- Upload File Baru -->
        <div class="mb-3">
            <label>Upload File Baru</label>
            <input type="file" name="files[]" class="form-control" multiple>
            <small class="text-muted">Tambahkan file baru. File lama tidak akan dihapus.</small>
        </div>

        <!-- File Lama -->
        @if($tahapan->media->count() > 0)
            <div class="mb-3">
                <label>File Lama</label>
                <ul>
                    @foreach($tahapan->media as $media)
                        <li>
                            <a href="{{ asset('storage/uploads/' . $media->ref_table . '/' . $media->file_url) }}" target="_blank">
                                {{ $media->file_url }}
                            </a>
                            <form action="{{ route('media.destroy', $media->media_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus file ini?')">Hapus</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="text-end">
            <a href="{{ route('tahapan.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Perbarui</button>
        </div>
    </form>
</div>
@endsection
