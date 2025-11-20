@extends('layouts.admin.app')

@section('content')

<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Edit Tahapan Proyek</h2>

        <form action="{{ route('tahapan.update', $tahapan->tahap_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Proyek</label>
                <select name="proyek_id" class="form-control" required>
                    @foreach ($proyek as $p)
                        <option value="{{ $p->proyek_id }}"
                            {{ $tahapan->proyek_id == $p->proyek_id ? 'selected' : '' }}>
                            {{ $p->nama_proyek }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                    <label for="nama_tahap" class="form-label">Nama Tahap</label>
    <select name="nama_tahap" class="form-select" required>
        @foreach ($pilihanTahap as $item)
            <option value="{{ $item }}" {{ $tahapan->nama_tahap == $item ? 'selected' : '' }}>
                {{ $item }}
            </option>
        @endforeach
    </select>
            </div>

            <div @extends('layouts.admin.app')

@section('content')

<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Edit Tahapan Proyek</h2>

        <form action="{{ route('tahapan.update', $tahapan->tahap_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Proyek</label>
                <select name="proyek_id" class="form-control" required>
                    @foreach ($proyek as $p)
                        <option value="{{ $p->proyek_id }}"
                            {{ old('proyek_id', $tahapan->proyek_id) == $p->proyek_id ? 'selected' : '' }}>
                            {{ $p->nama_proyek }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="nama_tahap" class="form-label">Nama Tahap</label>
                <select name="nama_tahap" class="form-select" required>
                    <option value="" disabled>-- Pilih Tahap --</option>
                    @foreach ($pilihanTahap as $item)
                        <option value="{{ $item }}"
                            {{ old('nama_tahap', $tahapan->nama_tahap) == $item ? 'selected' : '' }}>
                            {{ $item }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Target (%)</label>
                <input type="number" name="target_persen" class="form-control"
                       value="{{ old('target_persen', $tahapan->target_persen) }}" required>
            </div>

            <div class="mb-3">
                <label>Tanggal Mulai</label>
                <input type="date" name="tgl_mulai" class="form-control"
                       value="{{ old('tgl_mulai', $tahapan->tgl_mulai) }}" required>
            </div>

            <div class="mb-3">
                <label>Tanggal Selesai</label>
                <input type="date" name="tgl_selesai" class="form-control"
                       value="{{ old('tgl_selesai', $tahapan->tgl_selesai) }}" required>
            </div>

            <div class="text-end">
                <a href="{{ route('tahapan.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-success">Perbarui</button>
            </div>

        </form>
    </div>
</body>
@endsection
class="mb-3">
                <label>Target (%)</label>
                <input type="number" name="target_persen" class="form-control"
                       value="{{ $tahapan->target_persen }}" required>
            </div>

            <div class="mb-3">
                <label>Tanggal Mulai</label>
                <input type="date" name="tgl_mulai" class="form-control"
                       value="{{ $tahapan->tgl_mulai }}" required>
            </div>

            <div class="mb-3">
                <label>Tanggal Selesai</label>
                <input type="date" name="tgl_selesai" class="form-control"
                       value="{{ $tahapan->tgl_selesai }}" required>
            </div>

            <div class="text-end">
                <a href="{{ route('tahapan.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-success">Perbarui</button>
            </div>

        </form>
    </div>
</body>
@endsection
