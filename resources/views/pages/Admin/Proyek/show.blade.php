@extends('layouts.admin.app')

@section('content')
<div class="content">
    <div class="container-fluid pt-4 px-4">

        <h4 class="text-white text-center fw-bold mb-4">
            Detail Proyek
        </h4>

        {{-- ================= INFORMASI PROYEK ================= --}}
        <div class="bg-dark rounded p-4 mb-4">
            <h6 class="text-white mb-3">Informasi Proyek</h6>

            <table class="table table-dark table-bordered mb-0">
                <tr><th width="30%">Kode Proyek</th><td>{{ $proyek->kode_proyek }}</td></tr>
                <tr><th>Nama Proyek</th><td>{{ $proyek->nama_proyek }}</td></tr>
                <tr><th>Tahun</th><td>{{ $proyek->tahun }}</td></tr>
                <tr><th>Anggaran</th><td>Rp {{ number_format($proyek->anggaran,0,',','.') }}</td></tr>
                <tr><th>Sumber Dana</th><td>{{ $proyek->sumber_dana }}</td></tr>
                <tr><th>Deskripsi</th><td>{{ $proyek->deskripsi }}</td></tr>
            </table>
        </div>

        {{-- ================= KONTRAKTOR ================= --}}
        <div class="bg-dark rounded p-4 mb-4">
            <h6 class="text-white mb-3">Kontraktor</h6>

            @if($proyek->kontraktor->count())
                <table class="table table-dark table-bordered mb-0">
                    @foreach($proyek->kontraktor as $k)
                        <tr><th width="30%">Nama</th><td>{{ $k->nama }}</td></tr>
                        <tr><th>Penanggung Jawab</th><td>{{ $k->penanggung_jawab }}</td></tr>
                        <tr><th>Kontak</th><td>{{ $k->kontak }}</td></tr>
                        <tr><th>Alamat</th><td>{{ $k->alamat }}</td></tr>
                    @endforeach
                </table>
            @else
                <div class="text-center text-muted">Belum ada data kontraktor</div>
            @endif
        </div>

        {{-- ================= TAHAPAN PROYEK ================= --}}
        <div class="bg-dark rounded p-4 mb-4">
            <h6 class="text-white mb-3">Tahapan Proyek</h6>

            @if($proyek->tahapan->count())
                <table class="table table-dark table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Nama Tahap</th>
                            <th width="15%">Target (%)</th>
                            <th width="20%">Mulai</th>
                            <th width="20%">Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proyek->tahapan as $t)
                            <tr>
                                <td>{{ $t->nama_tahap }}</td>
                                <td>{{ $t->target_persen }}%</td>
                                <td>{{ $t->tgl_mulai }}</td>
                                <td>{{ $t->tgl_selesai }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center text-muted">Belum ada tahapan proyek</div>
            @endif
        </div>

        {{-- ================= PROGRES PROYEK ================= --}}
        <div class="bg-dark rounded p-4 mb-4">
            <h6 class="text-white mb-3">Progres Proyek</h6>

            @if($proyek->progres->count())
                <table class="table table-dark table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Tahap</th>
                            <th width="15%">Realisasi (%)</th>
                            <th width="20%">Tanggal</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proyek->progres as $p)
                            <tr>
                                <td>{{ $p->tahapan->nama_tahap ?? '-' }}</td>
                                <td>{{ $p->persen_real }}%</td>
                                <td>{{ $p->tanggal }}</td>
                                <td>{{ $p->catatan ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center text-muted">Belum ada progres proyek</div>
            @endif
        </div>

        {{-- ================= LOKASI PROYEK ================= --}}
        <div class="bg-dark rounded p-4 mb-4">
            <h6 class="text-white mb-3">Lokasi Proyek</h6>

            @if($proyek->lokasiProyek->count())
                <table class="table table-dark table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Latitude</th>
                            <th>Longitude</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proyek->lokasiProyek as $l)
                            <tr>
                                <td>{{ $l->lat }}</td>
                                <td>{{ $l->lng }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center text-muted">Belum ada lokasi proyek</div>
            @endif
        </div>

        {{-- ================= DOKUMEN PROYEK ================= --}}
        <div class="bg-dark rounded p-4 mb-4">
            <h6 class="text-white mb-3">Dokumen Proyek</h6>

            @if($proyek->media->count())
                <div class="row">
                    @foreach($proyek->media as $media)
                        @php $isImage = Str::startsWith($media->mime_type,'image'); @endphp
                        <div class="col-6 col-md-3 mb-3 text-center">
                            @if($isImage)
                                <img src="{{ asset($media->file_url) }}"
                                     class="img-fluid rounded"
                                     style="max-height:140px;object-fit:cover">
                            @else
                                <a href="{{ asset($media->file_url) }}" target="_blank">
                                    <i class="bi bi-file-earmark-text fs-1"></i>
                                    <div class="small">{{ $media->caption ?? 'File' }}</div>
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center opacity-75">
                    <img src="{{ asset('asset-admin/img/default-avatar.png') }}" width="80">
                    <div class="text-muted small">Belum ada dokumen proyek</div>
                </div>
            @endif
        </div>

        <a href="{{ route('proyek.index') }}" class="btn btn-secondary">
            Kembali
        </a>

    </div>
</div>
@endsection
