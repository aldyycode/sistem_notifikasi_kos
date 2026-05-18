@extends('layouts.app')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="p-6 max-w-7xl mx-auto">

    {{-- HEADER HALAMAN --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-semibold text-slate-900">Daftar Pembayaran</h2>
            <p class="text-sm text-slate-500 mt-1">Kelola tagihan, status pembayaran, dan pengingat WhatsApp.</p>
        </div>

        <a href="{{ route('pembayaran.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Pembayaran
        </a>
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false,
                customClass: {
                    popup: 'rounded-2xl'
                }
            });
        });
    </script>
    @endif

    {{-- CARD TABLE --}}
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                
                <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 font-medium">Nama Penghuni</th>
                        <th class="px-6 py-4 font-medium">Kamar</th>
                        <th class="px-6 py-4 font-medium">Tagihan</th>
                        <th class="px-6 py-4 font-medium">Jatuh Tempo</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 font-medium text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-200 text-slate-700">

                @forelse($pembayarans as $p)
                    <tr class="hover:bg-slate-50 transition-colors">
                        
                        {{-- NAMA PENGHUNI --}}
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-slate-900">
                            {{ $p->penghuni->nama_penghuni ?? '-' }}
                        </td>

                      {{-- KAMAR --}}
<td class="px-6 py-4 whitespace-nowrap">
    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">
        {{ $p->penghuni?->kamar?->nomor_kamar ?? '-' }}
    </span>
</td>

                        {{-- TAGIHAN --}}
                        <td class="px-6 py-4 whitespace-nowrap font-semibold text-emerald-600">
                            Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}
                        </td>

                        {{-- JATUH TEMPO --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($p->jatuh_tempo)->format('d M Y') }}
                        </td>

                        {{-- STATUS --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($p->status_bayar == 'belum_lunas')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span> Belum Lunas
                                </span>
                            @elseif($p->status_bayar == 'menunggu_verifikasi')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200">
                                    <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mr-1.5"></span> Menunggu Verifikasi
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5"></span> Lunas
                                </span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            
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

                            <div class="flex items-center justify-center gap-2">
                                
                                {{-- Tombol WA --}}
                                @if(!$sudahKirim)
                                <a href="{{ url('/pembayaran/'.$p->id_pembayaran.'/kirim-wa') }}" 
                                   class="inline-flex items-center px-3 py-1.5 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 rounded-lg transition-colors text-xs font-semibold" title="Kirim Pengingat WhatsApp">
                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                    Kirim WA
                                </a>
                                @endif

                                {{-- Tombol Konfirmasi --}}
                                @if($p->status_bayar == 'belum_lunas' || $p->status_bayar == 'menunggu_verifikasi')
                                <form action="{{ route('pembayaran.update', $p->id_pembayaran) }}" 
                                      method="POST" 
                                      class="inline-block"
                                      onsubmit="return confirmLunas(event, this)">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition-colors text-xs font-semibold" title="Konfirmasi Lunas">
                                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Konfirmasi
                                    </button>
                                </form>
                                @endif

                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-slate-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                <p>Belum ada data pembayaran</p>
                            </div>
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>
        </div>

    </div>

</div>

{{-- SWEETALERT KONFIRMASI LUNAS --}}
<script>
function confirmLunas(e, form){
    e.preventDefault();

    Swal.fire({
        title: 'Konfirmasi Pembayaran?',
        text: "Apakah Anda yakin ingin menandai tagihan ini sebagai lunas?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#10b981', // emerald-500 Tailwind
        cancelButtonColor: '#64748b',  // slate-500 Tailwind
        confirmButtonText: 'Ya, Lunas!',
        cancelButtonText: 'Batal',
        customClass: {
            popup: 'rounded-2xl'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>

@endsection