@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container">

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <h4 class="mb-4 fw-bold">💰 Tambah Pembayaran</h4>

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

            <form action="{{ route('pembayaran.store') }}" method="POST">
                @csrf

                {{-- PILIH PENGHUNI --}}
                <div class="mb-3">
                    <label class="form-label">Penghuni</label>
                    <select name="id_penghuni" class="form-select" required>
                        <option value="">-- Pilih Penghuni --</option>

                        @foreach($penghunis as $p)
                        <option value="{{ $p->id_penghuni }}">
                            {{ $p->nama_penghuni }} - Kamar {{ $p->nomor_kamar }}
                        </option>
                        @endforeach

                    </select>
                </div>

                {{-- JUMLAH --}}
                <div class="mb-3">
                    <label class="form-label">Jumlah Bayar</label>
                    <input type="number" 
                           name="jumlah_bayar" 
                           class="form-control"
                           placeholder="Contoh: 900000"
                           value="{{ old('jumlah_bayar') }}"
                           required>
                </div>

                {{-- JATUH TEMPO --}}
                <div class="mb-3">
                    <label class="form-label">Jatuh Tempo</label>
                    <input type="date" 
                           name="jatuh_tempo" 
                           class="form-control"
                           value="{{ old('jatuh_tempo') }}"
                           required>
                </div>

                {{-- BUTTON --}}
                <div class="d-flex justify-content-between">

                    <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">
                        ← Kembali
                    </a>

                    <button type="submit" class="btn btn-success">
                        💾 Simpan Pembayaran
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection