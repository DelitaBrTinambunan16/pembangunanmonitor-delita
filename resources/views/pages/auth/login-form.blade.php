@extends('layouts.auth.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('asset-admin/css/auth.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endpush

@section('content')
    <div class="container-fluid bg-dark text-light d-flex align-items-center justify-content-center min-vh-100">
        <div class="row w-100 align-items-stretch justify-content-center" style="max-width: 1000px;">

            <!-- KIRI: IDENTITAS -->
            <div
                class="col-lg-6 col-md-12 bg-secondary d-flex flex-column justify-content-center px-4 py-4 rounded-start shadow animate__animated animate__fadeInLeft">

                {{-- LOGO + JUDUL (DIJADIKAN SATU BLOK) --}}
                <div class="text-center mb-2">
                    <img src="{{ asset('asset-admin/img/logo_vertikal.png') }}" alt="Logo Bina Desa" width="180"
                        class="mb-1">

                    <h2 class="text-danger fw-bold mb-1">
                        Sistem Monitoring<br>Pembangunan Desa
                    </h2>
                </div>

                <p class="text-light small text-center mb-2" style="max-width: 420px; line-height: 1.6; margin: 0 auto;">
                    Aplikasi ini dikembangkan oleh <strong>mahasiswa Sistem Informasi</strong>
                    untuk membantu proses pengawasan dan pelaporan kegiatan pembangunan desa
                    secara <strong>transparan</strong>, <strong>efektif</strong>, dan <strong>akuntabel</strong>.
                </p>

                <small class="text-muted text-center mt-1">
                    © {{ date('Y') }} Sistem Informasi
                </small>
            </div>


            <!-- KANAN: LOGIN -->
            <div id="loginForm"
                class="col-lg-6 col-md-12 bg-secondary d-flex flex-column justify-content-center px-4 py-4 rounded-end shadow animate__animated animate__fadeInRight">

                <div class="text-center mb-3">
                    <h4 class="text-danger fw-bold mb-1">Login Admin</h4>
                    <small class="text-muted">Silakan masuk untuk melanjutkan</small>
                </div>

                {{-- Pesan Error --}}
                @if ($errors->any())
                    <div class="alert alert-danger py-2 animate__animated animate__shakeX">
                        {{ $errors->first() }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success py-2 animate__animated animate__fadeIn">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- FORM --}}
                <form action="{{ route('login.process') }}" method="POST">
                    @csrf

                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control bg-dark text-light border-0"
                            id="floatingInput" placeholder="name@example.com" value="{{ old('email') }}" required>
                        <label for="floatingInput">Email</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control bg-dark text-light border-0"
                            id="floatingPassword" placeholder="Password" required>
                        <label for="floatingPassword">Password</label>
                    </div>

                    <button type="submit" class="btn btn-danger py-3 w-100 fw-bold">
                        Masuk Sekarang
                    </button>
                </form>
            </div>

        </div>
    </div>
@endsection
