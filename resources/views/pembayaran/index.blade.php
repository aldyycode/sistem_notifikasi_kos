@extends('layouts.app')

@section('content')

{{-- CDN Bootstrap & SweetAlert --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">💰 Daftar Pembayaran</h3>

        <a href="{{ route('pembayaran.create') }}" class="btn btn-primary shadow">
            + Tambah Pembayaran
        </a>
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
    @endif

    {{-- CARD TABLE --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>Nama</th>
                            <th>Kamar</th>
                            <th>Tagihan</th>
                            <th>Jatuh Tempo</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    @foreach($pembayarans as $p)

                    <tr>

                        <td class="fw-semibold">
                            {{ $p->penghuni->nama_penghuni ?? '-' }}
                        </td>

                        <td>{{ $p->penghuni->nomor_kamar ?? '-' }}</td>

                        <td>
                            <span class="badge bg-info text-dark">
                                Rp {{ number_format($p->jumlah_bayar,0,',','.') }}
                            </span>
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($p->jatuh_tempo)->format('d M Y') }}
                        </td>

                        <td>
                            @if($p->status_bayar == 'belum_lunas')
                                <span class="badge bg-danger">Belum Lunas</span>
                            @elseif($p->status_bayar == 'menunggu_verifikasi')
                                <span class="badge bg-warning text-dark">Menunggu Verifikasi</span>
                            @else
                                <span class="badge bg-success">Lunas</span>
                            @endif
                        </td>

                        <td>

                            @php
                                $sudahKirim = false;

                                if($p->notifikasi){
                                    foreach($p->notifikasi as $n){
                                        if($n->jenis_reminder == 'Tagihan' && $n->status_kirim == 'terkirim'){
                                            $sudahKirim = true;
                                            break;
                                        }
                                    }
                                }
                            @endphp

                            {{-- Tombol WA --}}
                            @if(!$sudahKirim)
                            <a href="{{ url('/pembayaran/'.$p->id_pembayaran.'/kirim-wa') }}" 
                               class="btn btn-success btn-sm">
                                📲 Kirim WA
                            </a>
                            @endif

                            {{-- Tombol Konfirmasi --}}
                            @if($p->status_bayar == 'belum_lunas')

                            <form action="{{ route('pembayaran.update',$p->id_pembayaran) }}" 
                                  method="POST" 
                                  style="display:inline;"
                                  onsubmit="return confirmLunas(event,this)">

                                @csrf
                                @method('PUT')

                                <button class="btn btn-primary btn-sm">
                                    ✔ Konfirmasi
                                </button>

                            </form>

                            @endif

                        </td>

                    </tr>

                    @endforeach

                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

{{-- SWEETALERT KONFIRMASI --}}
<script>
function confirmLunas(e, form){
    e.preventDefault();

    Swal.fire({
        title: 'Konfirmasi Pembayaran?',
        text: "Apakah Anda yakin ingin menandai sebagai lunas?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#2ecc71',
        cancelButtonColor: '#e74c3c',
        confirmButtonText: 'Ya, Lunas!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>

@endsection