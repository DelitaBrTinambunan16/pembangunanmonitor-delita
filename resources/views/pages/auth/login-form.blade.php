@extends('layouts.auth.app')

@section('content')
<div class="container-fluid bg-dark text-light d-flex align-items-center justify-content-center min-vh-100">
    <div class="row w-100 d-flex align-items-stretch justify-content-center" style="max-width: 1000px;">

        <!-- Kolom Kiri: Identitas -->
        <div class="col-lg-6 col-md-12 bg-secondary d-flex flex-column justify-content-center align-items-center text-center p-5 rounded-start shadow animate__animated animate__fadeInLeft animate__faster">
            <img src="{{ asset('asset-admin/img/logo-desa.jpg') }}" alt="Logo Bina Desa" class="mb-4 shadow animate__animated animate__fadeInDown animate__delay-1s"
              style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; background-color: #fff; padding: 5px; border: 3px solid #dc3545;">
            <h2 class="text-danger fw-bold mb-3 animate__animated animate__fadeInDown animate__delay-2s">Sistem Monitoring Pembangunan Desa</h2>
            <p class="text-light mb-4 animate__animated animate__fadeInDown animate__delay-3s" style="max-width: 400px; line-height: 1.6;">
                Aplikasi ini dikembangkan oleh <strong>mahasiswa Sistem Informasi</strong> untuk membantu proses pengawasan dan pelaporan kegiatan pembangunan desa secara <strong>transparan</strong>, <strong>efektif</strong>, dan <strong>akuntabel</strong>.
            </p>
            <small class="text-muted mt-auto animate__animated animate__fadeInUp animate__delay-4s">© {{ date('Y') }} Kelompok Bina Desa - Sistem Informasi</small>
        </div>

        <!-- Kolom Kanan: Form Login -->
        <div id="loginForm" class="col-lg-6 col-md-12 bg-secondary d-flex flex-column justify-content-center p-5 rounded-end shadow animate__animated animate__fadeInRight animate__faster">
            <div class="text-center mb-4 animate__animated animate__fadeInDown animate__delay-1s">
                <h3 class="text-danger fw-bold mb-2"><i class="fa fa-user-edit me-2"></i>Login Admin</h3>
            </div>

            {{-- Pesan error atau sukses --}}
            @if($errors->any())
                <div id="errorMessage" class="alert alert-danger py-2 animate__animated animate__shakeX">{{ $errors->first() }}</div>
            @endif
            @if(session('success'))
                <div class="alert alert-success py-2 animate__animated animate__fadeIn">{{ session('success') }}</div>
            @endif

            {{-- Form Login --}}
            <form action="{{ route('login.process') }}" method="POST" class="mt-3">
                @csrf
                <div class="form-floating mb-3 animate__animated animate__fadeInUp animate__delay-2s">
                    <input type="email" name="email" class="form-control bg-dark text-light border-0"
                        id="floatingInput" placeholder="name@example.com" value="{{ old('email') }}" required>
                    <label for="floatingInput">Email</label>
                </div>

                <div class="form-floating mb-4 animate__animated animate__fadeInUp animate__delay-3s">
                    <input type="password" name="password" class="form-control bg-dark text-light border-0"
                        id="floatingPassword" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>

                <button type="submit" id="loginButton" class="btn btn-danger py-3 w-100 fw-bold mb-3 transition hover:scale-105 animate__animated animate__fadeInUp animate__delay-4s">
                    Masuk Sekarang
                </button>
            </form>
        </div>

    </div>
</div>

{{-- Animate.css CDN --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const loginButton = document.getElementById('loginButton');
        const loginForm = document.getElementById('loginForm');

        // Tambahkan efek goyang saat tombol ditekan
        loginButton.addEventListener('click', function(e){
            loginForm.classList.remove('animate__shakeX');
            void loginForm.offsetWidth; // trigger reflow
            loginForm.classList.add('animate__shakeX');
        });

        // Jika ada error, form juga goyang otomatis
        @if($errors->any())
            const errorDiv = document.getElementById('errorMessage');
            if(errorDiv){
                const parentForm = document.getElementById('loginForm');
                parentForm.classList.remove('animate__shakeX');
                void parentForm.offsetWidth;
                parentForm.classList.add('animate__shakeX');
            }
        @endif
    });
</script>
@endsection
