@extends('layouts.admin.app')

@section('content')
<div class="container-fluid pt-4 px-4">

    {{-- JUDUL --}}
    <h4 class="text-white text-center fw-bold mb-4">
        Identitas Pengembang Sistem
    </h4>

    <div class="row justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-6">

            <div class="bg-dark rounded-4 shadow p-4 text-center border border-secondary">

                {{-- FOTO --}}
                <img src="{{ asset('profile/foto.jpg') }}"
                     onerror="this.src='{{ asset('asset-admin/img/default-avatar.png') }}'"
                     class="rounded-circle border border-3 border-danger shadow mb-3"
                     width="140" height="140"
                     style="object-fit:cover">

                {{-- NAMA --}}
                <h5 class="text-white fw-bold mb-1">
                    DELITA BR TINAMBUNAN
                </h5>

                <div class="text-danger fw-semibold mb-3">
                    Sistem Informasi
                </div>

                {{-- BIODATA --}}
                <table class="table table-dark table-sm table-borderless text-start small mb-3">
                    <tr>
                        <td class="text-muted" width="35%">NIM</td>
                        <td>: 2457301031</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Prodi</td>
                        <td>: Sistem Informasi</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Status</td>
                        <td>: Mahasiswa</td>
                    </tr>
                </table>

                {{-- BADGE --}}
                <div class="mb-3">
                    <span class="badge bg-danger me-1">Laravel</span>
                    <span class="badge bg-secondary me-1">Bootstrap</span>
                    <span class="badge bg-dark border">Web App</span>
                </div>

                {{-- SOSIAL MEDIA --}}
                <div class="d-flex justify-content-center gap-3 mb-3">
                    <a href="https://www.linkedin.com/"
                       target="_blank"
                       class="btn btn-outline-primary rounded-circle"
                       title="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>

                    <a href="https://github.com/delitatinambunan16"
                       target="_blank"
                       class="btn btn-outline-light rounded-circle"
                       title="GitHub">
                        <i class="fab fa-github"></i>
                    </a>

                    <a href="https://instagram.com/delitatinambunan"
                       target="_blank"
                       class="btn btn-outline-danger rounded-circle"
                       title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>

                {{-- DESKRIPSI --}}
                <p class="text-muted small mb-0">
                    Halaman ini menampilkan identitas pengembang dari
                    <strong class="text-white">
                        Sistem Monitoring Pembangunan Proyek Desa
                    </strong>
                    sebagai bagian dari tugas pengembangan aplikasi berbasis web
                    menggunakan framework Laravel.
                </p>

            </div>

        </div>
    </div>

</div>
@endsection
