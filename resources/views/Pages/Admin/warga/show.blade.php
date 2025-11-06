@extends('Layouts.Admin.app')

@section('content')
<div class="content">
    <div class="container-fluid pt-4 px-4">
        <div class="bg-dark text-light rounded p-4">
            <h4 class="text-white mb-4">Detail Warga</h4>

            <table class="table table-dark table-bordered">
                <tr>
                    <th>No KTP</th>
                    <td>{{ $warga->no_ktp }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $warga->nama }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ $warga->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <th>Agama</th>
                    <td>{{ $warga->agama }}</td>
                </tr>
                <tr>
                    <th>Pekerjaan</th>
                    <td>{{ $warga->pekerjaan }}</td>
                </tr>
                <tr>
                    <th>Telp</th>
                    <td>{{ $warga->telp }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $warga->email }}</td>
                </tr>
            </table>

            <div class="mt-3">
                <a href="{{ route('warga.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
