@extends('layouts.admin.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Edit Kontraktor</h2>

        <form action="{{ route('kontraktor.update', $item->kontraktor_id) }}" method="POST">
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
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ $item->nama }}" required>
            </div>

            <div class="mb-3">
                <label>Penanggung Jawab</label>
                <input type="text" name="penanggung_jawab" class="form-control" value="{{ $item->penanggung_jawab }}">
            </div>

            <div class="mb-3">
                <label>Kontak</label>
                <input type="text" name="kontak" class="form-control" value="{{ $item->kontak }}">
            </div>

            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control">{{ $item->alamat }}</textarea>
            </div>

            <div class="text-end">
                <a href="{{ route('kontraktor.index') }}" class="btn btn-secondary">Kembali</a>
                <button class="btn btn-success">Update</button>
            </div>
        </form>
    </div>
@endsection
