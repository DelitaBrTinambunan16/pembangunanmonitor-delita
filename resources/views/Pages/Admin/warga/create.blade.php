@extends('Layouts.Admin.app')

@section('content')

<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Tambah Data Warga</h2>

        <form action="{{ route('warga.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>No KTP</label>
                <input type="text" name="no_ktp" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Agama</label>
                <input type="text" name="agama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Pekerjaan</label>
                <input type="text" name="pekerjaan" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Telp</label>
                <input type="text" name="telp" class="form-control">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="text-end">
                <a href="{{ route('warga.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</body>
@endsection
