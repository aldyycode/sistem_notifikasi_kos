{{-- ====================================== --}}
{{-- resources/views/kamar/show.blade.php --}}
{{-- ====================================== --}}

@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">🏠 Detail Kamar</h3>
            <small class="text-muted">Informasi lengkap data kamar</small>
        </div>

        <a href="{{ route('kamar.index') }}" class="btn btn-secondary">
            ← Kembali
        </a>
    </div>

    {{-- CARD --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            {{-- STATUS --}}
            <div class="mb-4">

                @if($kamar->status_kamar == 'kosong')
                    <span class="badge bg-success fs-6 px-3 py-2">
                        Kosong
                    </span>

                @elseif($kamar->status_kamar == 'terisi')
                    <span class="badge bg-danger fs-6 px-3 py-2">
                        Terisi
                    </span>

                @else
                    <span class="badge bg-warning text-dark fs-6 px-3 py-2">
                        Maintenance
                    </span>
                @endif

            </div>

            {{-- DATA --}}
            <div class="row g-4">

                <div class="col-md-6">
                    <label class="text-muted small">Nomor Kamar</label>
                    <div class="fw-bold fs-5">
                        {{ $kamar->nomor_kamar }}
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="text-muted small">Tipe Kamar</label>
                    <div class="fw-bold fs-5">
                        {{ $kamar->tipe_kamar }}
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="text-muted small">Luas Kamar</label>
                    <div class="fw-bold fs-5">
                        {{ $kamar->luas_kamar ?? '-' }}
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="text-muted small">Harga Sewa / Bulan</label>
                    <div class="fw-bold fs-5 text-success">
                        Rp {{ number_format($kamar->harga_sewa) }}
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="text-muted small">Lantai</label>
                    <div class="fw-bold fs-5">
                        {{ $kamar->lantai ?? '-' }}
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="text-muted small">Dibuat Pada</label>
                    <div class="fw-bold fs-5">
                        {{ $kamar->created_at ? $kamar->created_at->format('d M Y') : '-' }}
                    </div>
                </div>

                <div class="col-md-12">
                    <label class="text-muted small">Fasilitas</label>

                    <div class="border rounded-3 p-3 bg-light">
                        {{ $kamar->fasilitas ?: 'Tidak ada data fasilitas.' }}
                    </div>
                </div>

            </div>

            {{-- BUTTON --}}
            <div class="mt-4 d-flex gap-2">

                <a href="{{ route('kamar.edit', $kamar->id_kamar) }}"
                   class="btn btn-warning">
                   ✏ Edit
                </a>

                <a href="{{ route('kamar.index') }}"
                   class="btn btn-outline-secondary">
                   ← Kembali
                </a>

            </div>

        </div>
    </div>

</div>

@endsection