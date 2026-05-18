@extends('layouts.app')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="p-6 max-w-7xl mx-auto">

    <div class="mb-8">
        <h2 class="text-2xl font-semibold text-slate-900">Dashboard Sistem Kos</h2>
        <p class="text-sm text-slate-500 mt-1">Ringkasan data dan aktivitas kos saat ini.</p>
    </div>

    {{-- RINGKASAN (Grid 4 Kolom) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between">
            <div class="flex justify-between items-start">
                <span class="text-sm font-medium text-slate-500">Belum Lunas</span>
                <div class="p-2 bg-red-50 rounded-lg">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <span class="text-3xl font-bold text-slate-800 mt-4">{{ $chartData['pembayaran']['belum_lunas'] }}</span>
        </div>

        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between">
            <div class="flex justify-between items-start">
                <span class="text-sm font-medium text-slate-500">Lunas</span>
                <div class="p-2 bg-emerald-50 rounded-lg">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <span class="text-3xl font-bold text-slate-800 mt-4">{{ $chartData['pembayaran']['lunas'] }}</span>
        </div>

        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between">
            <div class="flex justify-between items-start">
                <span class="text-sm font-medium text-slate-500">Notif Terkirim</span>
                <div class="p-2 bg-blue-50 rounded-lg">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
            </div>
            <span class="text-3xl font-bold text-slate-800 mt-4">{{ $chartData['notifikasi']['terkirim'] }}</span>
        </div>

        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between">
            <div class="flex justify-between items-start">
                <span class="text-sm font-medium text-slate-500">Notif Gagal</span>
                <div class="p-2 bg-slate-100 rounded-lg">
                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
            </div>
            <span class="text-3xl font-bold text-slate-800 mt-4">{{ $chartData['notifikasi']['gagal'] }}</span>
        </div>

    </div>

    {{-- CHARTS BARIS 1 --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
            <h3 class="text-base font-semibold text-slate-800 mb-4">Statistik Pembayaran</h3>
            <div class="relative h-64">
                <canvas id="pembayaranChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
            <h3 class="text-base font-semibold text-slate-800 mb-4">Status Notifikasi</h3>
            <div class="relative h-64">
                <canvas id="notifikasiChart"></canvas>
            </div>
        </div>
    </div>

    {{-- CHARTS BARIS 2 --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
            <h3 class="text-base font-semibold text-slate-800 mb-4">Kinerja Reminder</h3>
            <div class="relative h-64">
                <canvas id="reminderChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
            <h3 class="text-base font-semibold text-slate-800 mb-4">Rating Penghuni</h3>
            <div class="relative h-64">
                <canvas id="ratingChart"></canvas>
            </div>
        </div>
    </div>

    {{-- NOTIFIKASI TERAKHIR (Tabel) --}}
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm mb-8 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200">
            <h3 class="text-base font-semibold text-slate-800">Notifikasi Terakhir</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 font-medium">Pesan</th>
                        <th class="px-6 py-4 font-medium">Tanggal</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 font-medium">Jenis</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-slate-700">
                @forelse($notifikasiTerakhir as $n)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">{{ Str::limit($n->isi_pesan, 50) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($n->tanggal_kirim)->format('d M Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($n->status_kirim == 'terkirim')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Terkirim</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Gagal</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $n->jenis_reminder ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-slate-500">Belum ada notifikasi.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ULASAN (Tabel) --}}
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden mb-8">
        <div class="px-6 py-5 border-b border-slate-200">
            <h3 class="text-base font-semibold text-slate-800">Review Penghuni</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 font-medium">Nama Penghuni</th>
                        <th class="px-6 py-4 font-medium">Rating</th>
                        <th class="px-6 py-4 font-medium">Ulasan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-slate-700">
                @foreach($ulasans as $u)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-slate-900">{{ $u->penghuni->nama_penghuni }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-amber-400 text-base">{!! str_repeat('★', $u->nilai_rating) !!}<span class="text-slate-200">{!! str_repeat('★', 5 - $u->nilai_rating) !!}</span></td>
                        <td class="px-6 py-4">{{ $u->isi_ulasan }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- SCRIPT CHART.JS CUSTOM --}}
<script>
const chartData = {!! json_encode($chartData) !!};

// Konfigurasi Global Font
Chart.defaults.font.family = "'Inter', sans-serif";
Chart.defaults.color = '#64748b'; // text-slate-500
Chart.defaults.plugins.tooltip.backgroundColor = '#0f172a'; // bg-slate-900
Chart.defaults.plugins.tooltip.padding = 10;
Chart.defaults.plugins.tooltip.cornerRadius = 8;

// Opsi Standar Bar Chart
const barOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: { legend: { display: false } },
    scales: {
        y: { beginAtZero: true, grid: { borderDash: [4, 4], color: '#e2e8f0' }, border: { display: false } },
        x: { grid: { display: false }, border: { display: false } }
    }
};

// 1. Pembayaran (Pie Chart)
new Chart(document.getElementById('pembayaranChart'), {
    type: 'doughnut', // Doughnut terlihat lebih modern dari pie biasa
    data: {
        labels: ['Belum Lunas', 'Lunas'],
        datasets: [{
            data: [chartData.pembayaran.belum_lunas, chartData.pembayaran.lunas],
            backgroundColor: ['#ef4444', '#10b981'], // Red-500, Emerald-500
            borderWidth: 0,
            hoverOffset: 4
        }]
    },
    options: { responsive: true, maintainAspectRatio: false, cutout: '70%' }
});

// 2. Notifikasi (Bar Chart)
new Chart(document.getElementById('notifikasiChart'), {
    type: 'bar',
    data: {
        labels: ['Terkirim', 'Gagal'],
        datasets: [{
            data: [chartData.notifikasi.terkirim, chartData.notifikasi.gagal],
            backgroundColor: ['#3b82f6', '#94a3b8'], // Blue-500, Slate-400
            borderRadius: 6,
            barThickness: 40
        }]
    },
    options: barOptions
});

// 3. Reminder (Bar Chart)
new Chart(document.getElementById('reminderChart'), {
    type: 'bar',
    data: {
        labels: Object.keys(chartData.reminder),
        datasets: [{
            data: Object.values(chartData.reminder),
            backgroundColor: '#6366f1', // Indigo-500
            borderRadius: 6
        }]
    },
    options: barOptions
});

// 4. Rating (Bar Chart)
new Chart(document.getElementById('ratingChart'), {
    type: 'bar',
    data: {
        labels: Object.keys(chartData.rating),
        datasets: [{
            data: Object.values(chartData.rating),
            backgroundColor: '#f59e0b', // Amber-500
            borderRadius: 6
        }]
    },
    options: barOptions
});
</script>

@endsection