@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f8fafc;
}

.detail-card{
    max-width: 950px;
    margin:auto;
    border-radius:18px;
}

.info-box{
    background:#f8f9fa;
    border-radius:12px;
    padding:14px 16px;
    height:100%;
    border:1px solid #edf0f2;
}

.label-text{
    font-size:13px;
    color:#6c757d;
    font-weight:600;
    margin-bottom:4px;
}

.value-text{
    font-size:16px;
    font-weight:700;
    color:#212529;
}

.badge-status{
    font-size:14px;
    padding:8px 14px;
    border-radius:30px;
}
</style>

<div class="container py-4">

    <div class="card shadow border-0 detail-card">
        <div class="card-body p-4">

            {{-- HEADER --}}
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                <div>
                    <h3 class="fw-bold mb-1">👤 Detail Penghuni</h3>
                    <p class="text-muted mb-0">Informasi lengkap penghuni kos.</p>
                </div>

                <a href="{{ route('penghuni.index') }}" class="btn btn-outline-secondary">
                    ← Kembali
                </a>
            </div>

            {{-- STATUS --}}
            <div class="mb-4">
                @if($penghuni->status_hunian == 'aktif')
                    <span class="badge bg-success badge-status">Aktif</span>
                @else
                    <span class="badge bg-secondary badge-status">Tidak Aktif</span>
                @endif
            </div>

            {{-- DATA UTAMA --}}
            <div class="row g-3">

                <div class="col-md-6">
                    <div class="info-box">
                        <div class="label-text">Nama Penghuni</div>
                        <div class="value-text">
                            {{ $penghuni->nama_penghuni }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="info-box">
                        <div class="label-text">Nomor Kamar</div>
                        <div class="value-text">
                            {{ $penghuni->kamar->nomor_kamar ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="info-box">
                        <div class="label-text">No WhatsApp</div>
                        <div class="value-text">
                            <a href="https://wa.me/62{{ substr($penghuni->no_wa,1) }}"
                               target="_blank"
                               class="text-success text-decoration-none">
                                {{ $penghuni->no_wa }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="info-box">
                        <div class="label-text">Gender</div>
                        <div class="value-text">
                            {{ $penghuni->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="info-box">
                        <div class="label-text">Tanggal Masuk</div>
                        <div class="value-text">
                            {{ $penghuni->tanggal_masuk ? \Carbon\Carbon::parse($penghuni->tanggal_masuk)->format('d M Y') : '-' }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="info-box">
                        <div class="label-text">Tanggal Keluar</div>
                        <div class="value-text">
                            {{ $penghuni->tanggal_keluar ? \Carbon\Carbon::parse($penghuni->tanggal_keluar)->format('d M Y') : '-' }}
                        </div>
                    </div>
                </div>

            </div>

            {{-- KONTAK DARURAT --}}
            <hr class="my-4">

            <h5 class="fw-bold mb-3">📞 Kontak Darurat</h5>

            <div class="row g-3">

                <div class="col-md-6">
                    <div class="info-box">
                        <div class="label-text">Nama Kontak</div>
                        <div class="value-text">
                            {{ $penghuni->nama_kontak_darurat ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="info-box">
                        <div class="label-text">No Kontak</div>
                        <div class="value-text">
                            {{ $penghuni->no_kontak_darurat ?? '-' }}
                        </div>
                    </div>
                </div>

            </div>

            {{-- BUTTON --}}
            <div class="mt-4 d-flex gap-2">

                <a href="{{ route('penghuni.edit', $penghuni->id_penghuni) }}"
                   class="btn btn-primary">
                   ✏️ Edit
                </a>

                <a href="{{ route('penghuni.index') }}"
                   class="btn btn-outline-secondary">
                   ← Kembali
                </a>

            </div>

        </div>
    </div>

</div>

@endsection