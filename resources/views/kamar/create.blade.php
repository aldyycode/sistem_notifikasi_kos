@extends('layouts.app')

@section('content')

<div class="p-6 max-w-4xl mx-auto">

    {{-- HEADER HALAMAN --}}
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-slate-900">Tambah Kamar</h2>
        <p class="text-sm text-slate-500 mt-1">Masukkan detail informasi untuk mendaftarkan kamar kos baru.</p>
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
            <form action="{{ route('kamar.store') }}" method="POST">
                @csrf

                <div class="mb-8">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4 border-b border-slate-100 pb-2">Spesifikasi Kamar</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Nomor Kamar <span class="text-red-500">*</span></label>
                            <input type="text" 
                                   name="nomor_kamar" 
                                   class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-800 focus:border-slate-800 transition-colors" 
                                   value="{{ old('nomor_kamar') }}" 
                                   placeholder="Contoh: A1, B2, 101" 
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Tipe Kamar <span class="text-red-500">*</span></label>
                            <input type="text" 
                                   name="tipe_kamar" 
                                   class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-800 focus:border-slate-800 transition-colors" 
                                   value="{{ old('tipe_kamar') }}" 
                                   placeholder="Contoh: VIP, Reguler, AC" 
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Luas Kamar</label>
                            <input type="text" 
                                   name="luas_kamar" 
                                   class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-800 focus:border-slate-800 transition-colors bg-slate-50 focus:bg-white" 
                                   value="{{ old('luas_kamar') }}" 
                                   placeholder="Contoh: 3x4 meter">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Harga Sewa (Rp)</label>
                            <input type="number" 
                                   name="harga_sewa" 
                                   class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-800 focus:border-slate-800 transition-colors bg-slate-50 focus:bg-white" 
                                   value="{{ old('harga_sewa') }}" 
                                   placeholder="Contoh: 1500000">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Lantai</label>
                            <input type="number" 
                                   name="lantai" 
                                   class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-800 focus:border-slate-800 transition-colors bg-slate-50 focus:bg-white" 
                                   value="{{ old('lantai') }}" 
                                   placeholder="Contoh: 1">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Status Kamar <span class="text-red-500">*</span></label>
                            <select name="status_kamar" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-800 focus:border-slate-800 transition-colors bg-white">
                                <option value="kosong" {{ old('status_kamar') == 'kosong' ? 'selected' : '' }}>Kosong</option>
                                <option value="terisi" {{ old('status_kamar') == 'terisi' ? 'selected' : '' }}>Terisi</option>
                                <option value="maintenance" {{ old('status_kamar') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Fasilitas</label>
                            <textarea name="fasilitas" 
                                      rows="3" 
                                      class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-800 focus:border-slate-800 transition-colors bg-slate-50 focus:bg-white resize-y" 
                                      placeholder="Contoh: AC, Kasur Springbed, Lemari Pakaian, Kamar Mandi Dalam">{{ old('fasilitas') }}</textarea>
                        </div>

                    </div>
                </div>

                {{-- BUTTONS --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-slate-100">
                    
                    <a href="{{ route('kamar.index') }}" class="inline-flex items-center justify-center px-6 py-2.5 border border-slate-300 shadow-sm text-sm font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50 transition-colors w-full sm:w-auto">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali
                    </a>

                    <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-slate-900 hover:bg-slate-800 transition-colors w-full sm:w-auto sm:ml-auto">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        Simpan Data
                    </button>
                    
                </div>

            </form>

        </div>
    </div>

</div>

@endsection