@extends('layouts.app')

@section('content')

{{-- Bootstrap & SweetAlert --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-4">

                <h4 class="fw-bold mb-4">✏️ Edit Penghuni</h4>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('penghuni.update', $penghuni->id_penghuni) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Nama Penghuni</label>
                        <input type="text" name="nama_penghuni"
                               value="{{ $penghuni->nama_penghuni }}"
                               class="form-control rounded-3" required>
                    </div>

                    <div class="mb-3">
                        <label>Nomor Kamar</label>
                        <input type="text" name="nomor_kamar"
                               value="{{ $penghuni->nomor_kamar }}"
                               class="form-control rounded-3" required>
                    </div>

                    <div class="mb-3">
                        <label>No WhatsApp</label>
                        <input type="text" name="no_wa"
                               value="{{ $penghuni->no_wa }}"
                               class="form-control rounded-3" required>
                    </div>

                    <div class="mb-4">
                        <label>Status Hunian</label>
                        <select name="status_hunian" class="form-control rounded-3">
                            <option value="aktif" {{ $penghuni->status_hunian == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak aktif" {{ $penghuni->status_hunian == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn btn-primary flex-fill">💾 Simpan</button>
                        <a href="/penghuni" class="btn btn-secondary flex-fill">← Kembali</a>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection