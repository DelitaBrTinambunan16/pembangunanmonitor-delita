@extends('Layouts.Admin.app')

@section('content')
<div class="login-card text-center">
        <h3 class="mb-3 text-light">Login Admin</h3>
        <p class="text-muted">Masuk untuk mengelola data proyek</p>

        @if(session('success'))
            <div class="alert alert-success py-2">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger py-2">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf
            <div class="mb-3 text-start">
                <label for="email" class="form-label text-light">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email" required autofocus value="{{ old('email') }}">
            </div>

            <div class="mb-4 text-start">
                <label for="password" class="form-label text-light">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn btn-login text-light fw-bold">Login</button>
        </form>

        <div class="mt-3">
            <small class="text-muted">© {{ date('Y') }} Sistem Pembangunan</small>
        </div>
    </div>

</body>
@endsection
