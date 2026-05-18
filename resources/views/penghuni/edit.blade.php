@extends('layouts.app')

@section('content')

<div class="p-6 max-w-4xl mx-auto">

    {{-- HEADER HALAMAN --}}
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-slate-900">Edit Data Penghuni</h2>
        <p class="text-sm text-slate-500 mt-1">Perbarui informasi penghuni kos. Pastikan data yang dimasukkan sudah benar.</p>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        
        <div class="p-6 sm:p-8">

            {{-- ERROR ALERT --}}
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-50 border-l-4 border-red-500">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-red-600 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <ul class="list-disc list-inside text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- FORM UTAMA --}}
            <form action="{{ route('penghuni.update', $penghuni->id_penghuni) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- SECTION: DATA UTAMA --}}
                <div class="mb-8">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4 border-b border-slate-100 pb-2">Data Utama</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Penghuni <span class="text-red-500">*</span></label>
                            <input type="text" 
                                   name="nama_penghuni" 
                                   class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-800 focus:border-slate-800 transition-colors" 
                                   value="{{ old('nama_penghuni', $penghuni->nama_penghuni) }}" 
                                   placeholder="Masukkan nama lengkap" 
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Pilih Kamar <span class="text-red-500">*</span></label>
                            <select name="kamar_id" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-800 focus:border-slate-800 transition-colors bg-white" required>
                                <option value="">-- Pilih Kamar --</option>
                                @foreach($kamars as $k)
                                    <option value="{{ $k->id }}" {{ old('kamar_id', $penghuni->kamar_id) == $k->id ? 'selected' : '' }}>
                                        Kamar {{ $k->nomor_kamar }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">No WhatsApp <span class="text-red-500">*</span></label>
                            <input type="text" 
                                   name="no_wa" 
                                   class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-800 focus:border-slate-800 transition-colors" 
                                   value="{{ old('no_wa', $penghuni->no_wa) }}" 
                                   placeholder="Contoh: 081234567890" 
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select name="gender" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-800 focus:border-slate-800 transition-colors bg-white" required>
                                <option value="L" {{ old('gender', $penghuni->gender) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('gender', $penghuni->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Tanggal Masuk <span class="text-red-500">*</span></label>
                            <input type="date" 
                                   name="tanggal_masuk" 
                                   class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-800 focus:border-slate-800 transition-colors" 
                                   value="{{ old('tanggal_masuk', $penghuni->tanggal_masuk) }}" 
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Tanggal Keluar</label>
                            <input type="date" 
                                   name="tanggal_keluar" 
                                   class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-800 focus:border-slate-800 transition-colors" 
                                   value="{{ old('tanggal_keluar', $penghuni->tanggal_keluar) }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Status Hunian <span class="text-red-500">*</span></label>
                            <select name="status_hunian" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-800 focus:border-slate-800 transition-colors bg-white" required>
                                <option value="aktif" {{ old('status_hunian', $penghuni->status_hunian) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ old('status_hunian', $penghuni->status_hunian) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>

                    </div>
                </div>

                {{-- SECTION: KONTAK DARURAT --}}
                <div class="mb-8">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4 border-b border-slate-100 pb-2">Kontak Darurat (Opsional)</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Kontak</label>
                            <input type="text" 
                                   name="nama_kontak_darurat" 
                                   class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-800 focus:border-slate-800 transition-colors bg-slate-50 focus:bg-white" 
                                   value="{{ old('nama_kontak_darurat', $penghuni->nama_kontak_darurat) }}" 
                                   placeholder="Nama keluarga / teman">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">No Kontak</label>
                            <input type="text" 
                                   name="no_kontak_darurat" 
                                   class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-800 focus:border-slate-800 transition-colors bg-slate-50 focus:bg-white" 
                                   value="{{ old('no_kontak_darurat', $penghuni->no_kontak_darurat) }}" 
                                   placeholder="Contoh: 081234567890">
                        </div>

                    </div>
                </div>

                {{-- BUTTONS --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-slate-100">
                    
                    <a href="{{ route('penghuni.index') }}" class="inline-flex items-center justify-center px-6 py-2.5 border border-slate-300 shadow-sm text-sm font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50 transition-colors w-full sm:w-auto">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali
                    </a>

                    <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-slate-900 hover:bg-slate-800 transition-colors w-full sm:w-auto sm:ml-auto">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        Simpan Perubahan
                    </button>
                    
                </div>

            </form>

        </div>
    </div>

</div>

@endsection