@extends('layouts.app')

@section('content')

<div class="p-6 max-w-4xl mx-auto">

    {{-- HEADER HALAMAN & TOMBOL KEMBALI --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-semibold text-slate-900">Detail Penghuni</h2>
            <p class="text-sm text-slate-500 mt-1">Informasi lengkap dan status hunian saat ini.</p>
        </div>

        <a href="{{ route('penghuni.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-slate-300 shadow-sm text-sm font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50 transition-colors">
            <svg class="w-4 h-4 mr-2 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    {{-- KARTU UTAMA --}}
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        
        {{-- HEADER KARTU (NAMA & STATUS) --}}
        <div class="px-6 py-5 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-slate-50/50">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-slate-900 flex items-center justify-center text-white font-bold text-lg shadow-sm">
                    {{ strtoupper(substr($penghuni->nama_penghuni, 0, 1)) }}
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-900">{{ $penghuni->nama_penghuni }}</h3>
                    <p class="text-sm text-slate-500 font-medium">Penghuni Kamar {{ $penghuni->kamar->nomor_kamar ?? '-' }}</p>
                </div>
            </div>

            <div>
                @if($penghuni->status_hunian == 'aktif')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 border border-emerald-200">
                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5"></span>
                        Aktif
                    </span>
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200">
                        <span class="w-1.5 h-1.5 bg-slate-400 rounded-full mr-1.5"></span>
                        Tidak Aktif
                    </span>
                @endif
            </div>
        </div>

        <div class="p-6">

            {{-- DATA UTAMA --}}
            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Informasi Pribadi</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                
                <div class="bg-slate-50 border border-slate-100 rounded-lg p-4">
                    <p class="text-xs font-medium text-slate-500 mb-1">Nomor Kamar</p>
                    <p class="text-base font-semibold text-slate-900">{{ $penghuni->kamar->nomor_kamar ?? '-' }}</p>
                </div>

                <div class="bg-slate-50 border border-slate-100 rounded-lg p-4">
                    <p class="text-xs font-medium text-slate-500 mb-1">No WhatsApp</p>
                    <a href="https://wa.me/62{{ substr($penghuni->no_wa, 1) }}" target="_blank" class="inline-flex items-center text-base font-semibold text-emerald-600 hover:text-emerald-700 transition-colors">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        {{ $penghuni->no_wa }}
                    </a>
                </div>

                <div class="bg-slate-50 border border-slate-100 rounded-lg p-4">
                    <p class="text-xs font-medium text-slate-500 mb-1">Jenis Kelamin</p>
                    <p class="text-base font-semibold text-slate-900">{{ $penghuni->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                </div>

                <div class="bg-slate-50 border border-slate-100 rounded-lg p-4">
                    <p class="text-xs font-medium text-slate-500 mb-1">Tanggal Masuk</p>
                    <p class="text-base font-semibold text-slate-900">{{ $penghuni->tanggal_masuk ? \Carbon\Carbon::parse($penghuni->tanggal_masuk)->format('d M Y') : '-' }}</p>
                </div>

                <div class="bg-slate-50 border border-slate-100 rounded-lg p-4">
                    <p class="text-xs font-medium text-slate-500 mb-1">Tanggal Keluar</p>
                    <p class="text-base font-semibold text-slate-900">{{ $penghuni->tanggal_keluar ? \Carbon\Carbon::parse($penghuni->tanggal_keluar)->format('d M Y') : '-' }}</p>
                </div>

            </div>

            {{-- KONTAK DARURAT --}}
            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4 border-t border-slate-100 pt-6">Kontak Darurat</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                
                <div class="bg-orange-50/50 border border-orange-100 rounded-lg p-4">
                    <p class="text-xs font-medium text-orange-600/70 mb-1">Nama Kontak</p>
                    <p class="text-base font-semibold text-slate-900">{{ $penghuni->nama_kontak_darurat ?? '-' }}</p>
                </div>

                <div class="bg-orange-50/50 border border-orange-100 rounded-lg p-4">
                    <p class="text-xs font-medium text-orange-600/70 mb-1">No Kontak</p>
                    <p class="text-base font-semibold text-slate-900">{{ $penghuni->no_kontak_darurat ?? '-' }}</p>
                </div>

            </div>

            {{-- FOOTER / ACTION BUTTONS --}}
            <div class="mt-8 pt-6 border-t border-slate-100 flex gap-3">
                <a href="{{ route('penghuni.edit', $penghuni->id_penghuni) }}" class="inline-flex items-center justify-center px-6 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Edit Data
                </a>
            </div>

        </div>
    </div>

</div>

@endsection