@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background: linear-gradient(135deg, #eef2ff, #f8fafc);
}

.form-card{
    max-width:900px;
    margin:auto;
    border-radius:20px;
    overflow:hidden;
}

.card-header-custom{
    background: linear-gradient(135deg, #22c55e, #4ade80);
    color:white;
    padding:20px 25px;
}

.card-header-custom h4{
    margin:0;
    font-weight:700;
}

.card-body{
    padding:30px;
}

.section-box{
    background:#f9fafb;
    padding:20px;
    border-radius:14px;
    margin-bottom:20px;
}

.section-title{
    font-size:13px;
    font-weight:700;
    color:#6b7280;
    text-transform:uppercase;
    margin-bottom:15px;
}

.form-control,
.form-select{
    border-radius:12px;
    padding:11px 14px;
    border:1px solid #e5e7eb;
    transition:.2s;
}

.form-control:focus,
.form-select:focus{
    border-color:#22c55e;
    box-shadow:0 0 0 3px rgba(34,197,94,0.15);
}

label{
    font-weight:600;
    margin-bottom:6px;
    font-size:14px;
}

.btn{
    border-radius:12px;
    padding:11px;
    font-weight:600;
}

.btn-primary{
    background:#22c55e;
    border:none;
}

.btn-primary:hover{
    background:#16a34a;
}
</style>

<div class="container py-5">

    <div class="card shadow border-0 form-card">

        {{-- HEADER --}}
        <div class="card-header-custom">
            <h4>➕ Tambah Penghuni</h4>
            <small class="opacity-75">Isi data penghuni kos dengan lengkap</small>
        </div>

        <div class="card-body">

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

            {{-- FORM UTAMA --}}
            <form action="{{ route('penghuni.store') }}" method="POST">
                @csrf

                {{-- DATA UTAMA --}}
                <div class="section-box">
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
                            <label>Pilih Kamar</label>
                            <select name="kamar_id" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Kamar --</option>
                                @foreach($kamars as $k)
                                   <option value="{{ $k->id }}">
    ID: {{ $k->id }} | Kamar: {{ $k->nomor_kamar }}
</option>
                                @endforeach
                            </select>
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
                                <option value="" disabled selected>-- Pilih Gender --</option>
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
                </div>

                {{-- KONTAK DARURAT --}}
                <div class="section-box">
                    <div class="section-title">Kontak Darurat</div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>Nama Kontak</label>
                            <input type="text"
                                   name="nama_kontak_darurat"
                                   class="form-control"
                                   value="{{ old('nama_kontak_darurat') }}"
                                   placeholder="Nama keluarga / teman">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>No Kontak</label>
                            <input type="text"
                                   name="no_kontak_darurat"
                                   class="form-control"
                                   value="{{ old('no_kontak_darurat') }}"
                                   placeholder="08xxxxxxxxxx">
                        </div>

                    </div>
                </div>

                {{-- BUTTON --}}
                <div class="d-flex gap-3 mt-3">
                    <a href="{{ route('penghuni.index') }}" class="btn btn-light border flex-fill">
                        ← Kembali
                    </a>

                    <button type="submit" class="btn btn-primary flex-fill">
                        💾 Simpan Data
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection