{{-- ============================= --}}
{{-- resources/views/kamar/edit.blade.php --}}
{{-- ============================= --}}

@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container">

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <h4 class="fw-bold mb-4">✏ Edit Kamar</h4>

            <form action="{{ route('kamar.update',$kamar->id_kamar) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Nomor Kamar</label>
                        <input type="text" name="nomor_kamar"
                               value="{{ $kamar->nomor_kamar }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Tipe Kamar</label>
                        <input type="text" name="tipe_kamar"
                               value="{{ $kamar->tipe_kamar }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Luas Kamar</label>
                        <input type="text" name="luas_kamar"
                               value="{{ $kamar->luas_kamar }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Harga Sewa</label>
                        <input type="number" name="harga_sewa"
                               value="{{ $kamar->harga_sewa }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Lantai</label>
                        <input type="number" name="lantai"
                               value="{{ $kamar->lantai }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Status Kamar</label>
                        <select name="status_kamar" class="form-select">
                            <option value="kosong" {{ $kamar->status_kamar=='kosong' ? 'selected' : '' }}>Kosong</option>
                            <option value="terisi" {{ $kamar->status_kamar=='terisi' ? 'selected' : '' }}>Terisi</option>
                            <option value="maintenance" {{ $kamar->status_kamar=='maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Fasilitas</label>
                        <textarea name="fasilitas" rows="3" class="form-control">{{ $kamar->fasilitas }}</textarea>
                    </div>

                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('kamar.index') }}" class="btn btn-secondary">
                        ← Kembali
                    </a>

                    <button class="btn btn-primary">
                        💾 Update
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection