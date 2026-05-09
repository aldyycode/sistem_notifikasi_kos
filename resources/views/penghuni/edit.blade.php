@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background: linear-gradient(135deg, #eef2ff, #f8fafc);
}

.edit-card{
    max-width:950px;
    margin:auto;
    border-radius:20px;
    overflow:hidden;
}

.card-header-custom{
    background: linear-gradient(135deg, #4f46e5, #6366f1);
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

.form-control,
.form-select{
    border-radius:12px;
    padding:11px 14px;
    border:1px solid #e5e7eb;
    transition: all .2s ease;
}

.form-control:focus,
.form-select:focus{
    border-color:#6366f1;
    box-shadow:0 0 0 3px rgba(99,102,241,0.15);
}

label{
    font-weight:600;
    margin-bottom:6px;
    font-size:14px;
}

.section-title{
    font-size:13px;
    font-weight:700;
    color:#6b7280;
    text-transform:uppercase;
    letter-spacing:.6px;
    margin-bottom:15px;
}

.section-box{
    background:#f9fafb;
    padding:20px;
    border-radius:14px;
    margin-bottom:20px;
}

.btn{
    border-radius:12px;
    padding:11px;
    font-weight:600;
}

.btn-primary{
    background:#4f46e5;
    border:none;
}

.btn-primary:hover{
    background:#4338ca;
}

</style>

<div class="container py-5">

    <div class="card shadow border-0 edit-card">

        {{-- HEADER --}}
        <div class="card-header-custom">
            <h4>✏️ Edit Penghuni</h4>
            <small class="opacity-75">Perbarui data penghuni dengan benar</small>
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

            <form action="{{ route('penghuni.update', $penghuni->id_penghuni) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- DATA UTAMA --}}
                <div class="section-box">
                    <div class="section-title">Data Utama</div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>Nama Penghuni</label>
                            <input type="text"
                                   name="nama_penghuni"
                                   placeholder="Masukkan nama penghuni"
                                   value="{{ old('nama_penghuni', $penghuni->nama_penghuni) }}"
                                   class="form-control"
                                   required>
                        </div>
<div class="col-md-6 mb-3">
    <label>Pilih Kamar</label>
    <select name="kamar_id" class="form-select" required>
        <option value="">-- Pilih Kamar --</option>

        @foreach($kamars as $k)
            <option value="{{ $k->id }}"
                {{ old('kamar_id', $penghuni->kamar_id) == $k->id ? 'selected' : '' }}>
                Kamar {{ $k->nomor_kamar }}
            </option>
        @endforeach
    </select>
</div>
                        <div class="col-md-6 mb-3">
                            <label>No WhatsApp</label>
                            <input type="text"
                                   name="no_wa"
                                   placeholder="08xxxxxxxxxx"
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
                </div>

                {{-- KONTAK DARURAT --}}
                <div class="section-box">
                    <div class="section-title">Kontak Darurat</div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>Nama Kontak</label>
                            <input type="text"
                                   name="nama_kontak_darurat"
                                   placeholder="Nama keluarga / teman"
                                   value="{{ old('nama_kontak_darurat', $penghuni->nama_kontak_darurat) }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>No Kontak</label>
                            <input type="text"
                                   name="no_kontak_darurat"
                                   placeholder="08xxxxxxxxxx"
                                   value="{{ old('no_kontak_darurat', $penghuni->no_kontak_darurat) }}"
                                   class="form-control">
                        </div>

                    </div>
                </div>

                {{-- BUTTON --}}
                <div class="d-flex gap-3 mt-3">
                    <button type="submit" class="btn btn-primary flex-fill">
                        💾 Simpan Perubahan
                    </button>

                    <a href="{{ route('penghuni.index') }}" class="btn btn-light border flex-fill">
                        ← Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection