@extends('layouts.app')

@section('content')

{{-- Bootstrap & SweetAlert --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
body{
    background:#f8fafc;
}

.edit-card{
    max-width:900px;
    margin:auto;
    border-radius:18px;
}

.form-control,
.form-select{
    border-radius:10px;
    padding:10px 14px;
}

label{
    font-weight:600;
    margin-bottom:6px;
}

.section-title{
    font-size:14px;
    font-weight:700;
    color:#6c757d;
    text-transform:uppercase;
    letter-spacing:.5px;
    margin-bottom:15px;
}

.btn{
    border-radius:10px;
    padding:10px 18px;
}
</style>

<div class="container py-4">

    <div class="card shadow border-0 edit-card">
        <div class="card-body p-4">

            {{-- HEADER --}}
            <div class="mb-4">
                <h3 class="fw-bold mb-1">✏️ Edit Penghuni</h3>
                <p class="text-muted mb-0">Perbarui data penghuni dan kamar yang ditempati.</p>
            </div>

            {{-- ERROR --}}
            @if ($errors->any())
                <div class="alert alert-danger rounded-3">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('penghuni.update', $penghuni->id_penghuni) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- DATA UTAMA --}}
                <div class="section-title">Data Utama</div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Nama Penghuni</label>
                        <input type="text"
                               name="nama_penghuni"
                               value="{{ old('nama_penghuni', $penghuni->nama_penghuni) }}"
                               class="form-control"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Pilih Kamar</label>
                        <select name="id_kamar" class="form-select" required>
                            <option value="">-- Pilih Kamar --</option>

                            @foreach($kamars as $k)
                                <option value="{{ $k->id_kamar }}"
                                    {{ old('id_kamar', $penghuni->id_kamar) == $k->id_kamar ? 'selected' : '' }}>
                                    {{ $k->nomor_kamar }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>No WhatsApp</label>
                        <input type="text"
                               name="no_wa"
                               value="{{ old('no_wa', $penghuni->no_wa) }}"
                               class="form-control"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Gender</label>
                        <select name="gender" class="form-select" required>
                            <option value="L" {{ old('gender', $penghuni->gender) == 'L' ? 'selected' : '' }}>
                                Laki-laki
                            </option>

                            <option value="P" {{ old('gender', $penghuni->gender) == 'P' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Tanggal Masuk</label>
                        <input type="date"
                               name="tanggal_masuk"
                               value="{{ old('tanggal_masuk', $penghuni->tanggal_masuk) }}"
                               class="form-control"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Tanggal Keluar</label>
                        <input type="date"
                               name="tanggal_keluar"
                               value="{{ old('tanggal_keluar', $penghuni->tanggal_keluar) }}"
                               class="form-control">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Status Hunian</label>
                        <select name="status_hunian" class="form-select">
                            <option value="aktif" {{ old('status_hunian', $penghuni->status_hunian) == 'aktif' ? 'selected' : '' }}>
                                Aktif
                            </option>

                            <option value="nonaktif" {{ old('status_hunian', $penghuni->status_hunian) == 'nonaktif' ? 'selected' : '' }}>
                                Nonaktif
                            </option>
                        </select>
                    </div>

                </div>

                {{-- KONTAK DARURAT --}}
                <div class="section-title mt-3">Kontak Darurat</div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Nama Kontak Darurat</label>
                        <input type="text"
                               name="nama_kontak_darurat"
                               value="{{ old('nama_kontak_darurat', $penghuni->nama_kontak_darurat) }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>No Kontak Darurat</label>
                        <input type="text"
                               name="no_kontak_darurat"
                               value="{{ old('no_kontak_darurat', $penghuni->no_kontak_darurat) }}"
                               class="form-control">
                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="d-flex gap-2 mt-4">

                    <button type="submit" class="btn btn-primary flex-fill">
                        💾 Simpan Perubahan
                    </button>

                    <a href="{{ route('penghuni.index') }}" class="btn btn-outline-secondary flex-fill">
                        ← Kembali
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection