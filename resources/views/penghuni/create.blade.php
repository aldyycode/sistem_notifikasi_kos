@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
body{
    background: #f8fafc;
}

.form-card{
    max-width: 850px;
    margin: auto;
    border-radius: 18px;
}

.section-title{
    font-size: 14px;
    font-weight: 700;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-bottom: 15px;
}

.form-control,
.form-select{
    border-radius: 10px;
    padding: 10px 14px;
}

label{
    font-weight: 600;
    margin-bottom: 6px;
}

.btn{
    border-radius: 10px;
    padding: 10px 20px;
}
</style>

<div class="container py-4">

    <div class="card shadow border-0 form-card">
        <div class="card-body p-4">

            <div class="mb-4">
                <h3 class="fw-bold mb-1">➕ Tambah Penghuni</h3>
                <p class="text-muted mb-0">Lengkapi data penghuni kos dengan benar.</p>
            </div>

            {{-- ERROR VALIDASI --}}
            @if ($errors->any())
                <div class="alert alert-danger rounded-3">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('penghuni.store') }}" method="POST">
                @csrf

                {{-- DATA UTAMA --}}
                <div class="section-title">Data Utama</div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nama Penghuni</label>
                        <input type="text" 
                               name="nama_penghuni"
                               class="form-control"
                               value="{{ old('nama_penghuni') }}"
                               placeholder="Masukkan nama penghuni"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Nomor Kamar</label>
                        <input type="text"
                               name="nomor_kamar"
                               class="form-control"
                               value="{{ old('nomor_kamar') }}"
                               placeholder="Contoh: A1"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>No WhatsApp</label>
                        <input type="text"
                               name="no_wa"
                               class="form-control"
                               value="{{ old('no_wa') }}"
                               placeholder="08xxxxxxxxxx"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Gender</label>
                        <select name="gender" class="form-select" required>
                            <option value="">-- Pilih Gender --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Tanggal Masuk</label>
                        <input type="date"
                               name="tanggal_masuk"
                               class="form-control"
                               value="{{ old('tanggal_masuk') }}"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Status Hunian</label>
                        <select name="status_hunian" class="form-select">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
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
                               class="form-control"
                               value="{{ old('nama_kontak_darurat') }}"
                               placeholder="Nama keluarga / kerabat">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>No Kontak Darurat</label>
                        <input type="text"
                               name="no_kontak_darurat"
                               class="form-control"
                               value="{{ old('no_kontak_darurat') }}"
                               placeholder="08xxxxxxxxxx">
                    </div>
                </div>

                {{-- BUTTON --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('penghuni.index') }}" class="btn btn-outline-secondary">
                        ← Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        💾 Simpan Data
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection