@extends('layouts.app')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="p-6 max-w-7xl mx-auto">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-semibold text-slate-900">Master Kamar</h2>
            <p class="text-sm text-slate-500 mt-1">Kelola data kamar, tipe, harga, dan status ketersediaan.</p>
        </div>

        <a href="{{ route('kamar.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Kamar
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
                        <th class="px-6 py-4 font-medium">No Kamar</th>
                        <th class="px-6 py-4 font-medium">Tipe</th>
                        <th class="px-6 py-4 font-medium">Luas</th>
                        <th class="px-6 py-4 font-medium">Harga</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 font-medium text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-200 text-slate-700">

                @forelse($kamars as $k)
                    <tr class="hover:bg-slate-50 transition-colors">
                        
                        {{-- NO KAMAR --}}
                        <td class="px-6 py-4 whitespace-nowrap font-semibold text-slate-900">
                            {{ $k->nomor_kamar }}
                        </td>

                        {{-- TIPE --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $k->tipe_kamar }}
                        </td>

                        {{-- LUAS --}}
                        <td class="px-6 py-4 whitespace-nowrap text-slate-500">
                            {{ $k->luas_kamar }}
                        </td>

                        {{-- HARGA --}}
                        <td class="px-6 py-4 whitespace-nowrap font-semibold text-emerald-600">
                            Rp {{ number_format($k->harga_sewa, 0, ',', '.') }}
                        </td>

                        {{-- STATUS --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($k->status_kamar == 'kosong')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                    Kosong
                                </span>
                            @elseif($k->status_kamar == 'terisi')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Terisi
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                    Maintenance
                                </span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center gap-2">
                                
                                <a href="{{ route('kamar.show', $k->id) }}" 
                                   class="inline-flex items-center justify-center p-2 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors" title="Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>

                                <a href="{{ route('kamar.edit', $k->id) }}" 
                                   class="inline-flex items-center justify-center p-2 text-amber-600 bg-amber-50 hover:bg-amber-100 rounded-lg transition-colors" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>

                                <form action="{{ route('kamar.destroy', $k->id) }}" 
                                      method="POST" 
                                      class="inline-block"
                                      onsubmit="return confirmDelete(event, this)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center p-2 text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-slate-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                <p>Belum ada data kamar</p>
                            </div>
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>
        </div>

    </div>

</div>

{{-- SWEETALERT DELETE SCRIPT --}}
<script>
function confirmDelete(e, form){
    e.preventDefault();

    Swal.fire({
        title: 'Hapus Data?',
        text: 'Data kamar akan dihapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444', // red-500 Tailwind
        cancelButtonColor: '#64748b',  // slate-500 Tailwind
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal',
        customClass: {
            popup: 'rounded-2xl'
        }
    }).then((result) => {
        if(result.isConfirmed){
            form.submit();
        }
    });
}
</script>

@endsection