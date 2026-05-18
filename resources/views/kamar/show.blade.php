@extends('layouts.app')

@section('content')

<div class="p-6 max-w-4xl mx-auto">

    {{-- HEADER HALAMAN & TOMBOL KEMBALI --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-semibold text-slate-900">Detail Kamar</h2>
            <p class="text-sm text-slate-500 mt-1">Informasi lengkap spesifikasi, harga, dan status kamar kos.</p>
        </div>

        <a href="{{ route('kamar.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-slate-300 shadow-sm text-sm font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50 transition-colors">
            <svg class="w-4 h-4 mr-2 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    {{-- KARTU UTAMA --}}
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        
        {{-- HEADER KARTU (NOMOR KAMAR, TIPE & STATUS) --}}
        <div class="px-6 py-5 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-slate-50/50">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-slate-900 flex items-center justify-center text-white shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-900">{{ $kamar->nomor_kamar }}</h3>
                    <p class="text-sm text-slate-500 font-medium">Tipe: {{ $kamar->tipe_kamar }}</p>
                </div>
            </div>

            <div>
                @if($kamar->status_kamar == 'kosong')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 border border-emerald-200">
                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5"></span>Kosong
                    </span>
                @elseif($kamar->status_kamar == 'terisi')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800 border border-red-200">
                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>Terisi
                    </span>
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 border border-amber-200">
                        <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mr-1.5"></span>Maintenance
                    </span>
                @endif
            </div>
        </div>

        <div class="p-6">

            {{-- DATA SPESIFIKASI --}}
            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Spesifikasi Detail</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                
                <div class="bg-slate-50 border border-slate-100 rounded-lg p-4">
                    <p class="text-xs font-medium text-slate-500 mb-1">Harga Sewa / Bulan</p>
                    <p class="text-lg font-bold text-emerald-600">Rp {{ number_format($kamar->harga_sewa, 0, ',', '.') }}</p>
                </div>

                <div class="bg-slate-50 border border-slate-100 rounded-lg p-4">
                    <p class="text-xs font-medium text-slate-500 mb-1">Luas Kamar</p>
                    <p class="text-base font-semibold text-slate-900">{{ $kamar->luas_kamar ?? '-' }}</p>
                </div>

                <div class="bg-slate-50 border border-slate-100 rounded-lg p-4">
                    <p class="text-xs font-medium text-slate-500 mb-1">Lantai</p>
                    <p class="text-base font-semibold text-slate-900">{{ $kamar->lantai ?? '-' }}</p>
                </div>

                <div class="bg-slate-50 border border-slate-100 rounded-lg p-4">
                    <p class="text-xs font-medium text-slate-500 mb-1">Data Didaftarkan Pada</p>
                    <p class="text-base font-semibold text-slate-900">{{ $kamar->created_at ? $kamar->created_at->format('d M Y') : '-' }}</p>
                </div>

            </div>

            {{-- FASILITAS --}}
            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4 border-t border-slate-100 pt-6">Fasilitas Kamar</h4>
            <div class="bg-slate-50 border border-slate-100 rounded-lg p-5">
                @if($kamar->fasilitas)
                    <p class="text-sm text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $kamar->fasilitas }}</p>
                @else
                    <p class="text-sm text-slate-400 italic">Tidak ada data fasilitas yang dicatat.</p>
                @endif
            </div>

            {{-- FOOTER / ACTION BUTTONS --}}
            <div class="mt-8 pt-6 border-t border-slate-100 flex gap-3">
                <a href="{{ route('kamar.edit', $kamar->id) }}" class="inline-flex items-center justify-center px-6 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Edit Data Kamar
                </a>
            </div>

        </div>
    </div>

</div>

@endsection