{{-- ============================= --}}
{{-- resources/views/kamar/create.blade.php --}}
{{-- ============================= --}}

@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container">

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <h4 class="fw-bold mb-4">➕ Tambah Kamar</h4>

            <form action="{{ route('kamar.store') }}" method="POST">
                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Nomor Kamar</label>
                        <input type="text" name="nomor_kamar" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Tipe Kamar</label>
                        <input type="text" name="tipe_kamar" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Luas Kamar</label>
                        <input type="text" name="luas_kamar" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Harga Sewa</label>
                        <input type="number" name="harga_sewa" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Lantai</label>
                        <input type="number" name="lantai" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Status Kamar</label>
                        <select name="status_kamar" class="form-select">
                            <option value="kosong">Kosong</option>
                            <option value="terisi">Terisi</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Fasilitas</label>
                        <textarea name="fasilitas" rows="3" class="form-control"></textarea>
                    </div>

                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('kamar.index') }}" class="btn btn-secondary">
                        ← Kembali
                    </a>

                    <button class="btn btn-primary">
                        💾 Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection