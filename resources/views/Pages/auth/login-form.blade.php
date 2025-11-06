@extends('Layouts.auth.app')

@section('content')
<div class="container-fluid bg-dark text-light d-flex align-items-center justify-content-center min-vh-100">
    <div class="row w-100 d-flex align-items-stretch justify-content-center" style="max-width: 1000px;">

        <!-- Kolom Kiri: Identitas -->
        <div class="col-lg-6 col-md-12 bg-secondary d-flex flex-column justify-content-center align-items-center text-center p-5 rounded-start shadow">
            <img src="{{ asset('asset-admin/img/logo-desa.jpg') }}" alt="Logo Bina Desa" class="mb-4 shadow"
              style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; background-color: #fff; padding: 5px; border: 3px solid #dc3545;">
            <h2 class="text-danger fw-bold mb-3">Sistem Monitoring Pembangunan Desa</h2>
            <p class="text-light mb-4" style="max-width: 400px; line-height: 1.6;">
                Aplikasi ini dikembangkan oleh <strong>mahasiswa Sistem Informasi</strong> untuk membantu proses pengawasan dan pelaporan kegiatan pembangunan desa secara <strong>transparan</strong>, <strong>efektif</strong>, dan <strong>akuntabel</strong>.
            </p>
            <small class="text-muted mt-auto">© {{ date('Y') }} Kelompok Bina Desa - Sistem Informasi</small>
        </div>

        <!-- Kolom Kanan: Form Login -->
        <div class="col-lg-6 col-md-12 bg-secondary d-flex flex-column justify-content-center p-5 rounded-end shadow">
            <div class="text-center mb-4">
                <h3 class="text-danger fw-bold mb-2"><i class="fa fa-user-edit me-2"></i>Login Admin</h3>
            </div>

            {{-- Pesan error atau sukses --}}
            @if($errors->any())
                <div class="alert alert-danger py-2">{{ $errors->first() }}</div>
            @endif
            @if(session('success'))
                <div class="alert alert-success py-2">{{ session('success') }}</div>
            @endif

            {{-- Form Login --}}
            <form action="{{ route('login.process') }}" method="POST" class="mt-3">
                @csrf
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control bg-dark text-light border-0"
                        id="floatingInput" placeholder="name@example.com" value="{{ old('email') }}" required>
                    <label for="floatingInput">Email</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="password" name="password" class="form-control bg-dark text-light border-0"
                        id="floatingPassword" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>

                <button type="submit" class="btn btn-danger py-3 w-100 fw-bold mb-3">Masuk Sekarang</button>
            </form>
        </div>

    </div>
</div>
@endsection
