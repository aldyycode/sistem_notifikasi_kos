@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container">

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <h4 class="mb-4 fw-bold">➕ Tambah Penghuni</h4>

            {{-- ERROR VALIDASI --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('penghuni.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Penghuni</label>
                    <input type="text" name="nama_penghuni" 
                           class="form-control"
                           value="{{ old('nama_penghuni') }}"
                           placeholder="Masukkan nama penghuni" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor Kamar</label>
                    <input type="text" name="nomor_kamar" 
                           class="form-control"
                           value="{{ old('nomor_kamar') }}"
                           placeholder="Contoh: A1, B2" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">No WhatsApp</label>
                    <input type="text" name="no_wa" 
                           class="form-control"
                           value="{{ old('no_wa') }}"
                           placeholder="Contoh: 0822xxxx" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status Hunian</label>
                    <select name="status_hunian" class="form-select">
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">

                    <a href="{{ route('penghuni.index') }}" class="btn btn-secondary">
                        ← Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        💾 Simpan
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection